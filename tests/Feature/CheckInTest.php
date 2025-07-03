<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\CheckIn;
use Tests\TestCase;

class CheckInTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to ensure that all check-ins can be viewed.
     *
     * This test verifies that the endpoint or functionality responsible for retrieving
     * all check-ins works as expected and returns the correct data.
     *
     * @return void
     */
    public function test_can_view_all_check_ins(): void
    {
        // Create check-ins for other users (in different companies)
        CheckIn::factory()->count(3)->create();
        $response = $this->getJson('/check-ins');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'lat',
                        'lng',
                        'description',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }

    /**
     * Test to ensure that a check-in can be successfully created.
     *
     * This test verifies the application's ability to handle the creation
     * of a new check-in record, ensuring that all necessary validations
     * and database operations are performed as expected.
     *
     * @return void
     */
    public function test_can_create_checkin()
    {
        $checkInData = [
            'lat'         => 40.7128,
            'lng'         => -74.0060,
            'description' => 'Test check-in',
            'notes'       => 'noted!',
        ];

        $response = $this->postJson('/check-ins', $checkInData);
        $response = $this->getJson('/check-ins');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'lat',
                        'lng',
                        'description',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);

        $this->assertDatabaseHas('check_ins', [
            'lat'         => 40.7128,
            'lng'         => -74.0060,
            'description' => 'Test check-in',
            'notes'       => 'noted!',
        ]);
    }

    /**
     * Test that a check-in record can be successfully updated.
     *
     * This test verifies that the update functionality for a check-in works as expected,
     * ensuring that the relevant data is modified and persisted correctly.
     *
     * @return void
     */
    public function test_can_update_checkin()
    {
        $checkIn = CheckIn::factory()->create();

        $updateData = [
            'description' => 'Updated description',
            'notes'       => 'Updated notes',
            'lat'         => $checkIn->lat, // Keep the same coordinates
            'lng'         => $checkIn->lng, // Keep the same coordinates
        ];

        $response = $this->putJson("check-ins/{$checkIn->id}", $updateData);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id'          => $checkIn->id,
                    'description' => 'Updated description',
                    'notes'       => 'Updated notes',
                ]
            ]);

        $this->assertDatabaseHas('check_ins', [
            'id'          => $checkIn->id,
            'description' => 'Updated description',
            'notes'       => 'Updated notes',
        ]);
    }

    /**
     * Test that a check-in can be successfully deleted.
     *
     * This test ensures that the delete functionality for check-ins works as expected.
     *
     * @return void
     */
    public function test_can_delete_checkin()
    {
        $checkIn = CheckIn::factory()->create();

        $response = $this->deleteJson("/check-ins/{$checkIn->id}");
        $response->assertStatus(200);

        $this->assertDatabaseMissing('check_ins', [
            'id' => $checkIn->id,
        ]);
    }

    public function test_create_checkin_validation_fails_with_missing_description()
    {
        $response = $this->postJson('/check-ins', [
            'lat' => 40.7128,
            'lng' => -74.0060,
            // missing description
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['description']);
    }

    public function test_delete_nonexistent_checkin_returns_404()
    {
        $response = $this->deleteJson('/check-ins/999999');
        $response->assertStatus(404);
    }
}
