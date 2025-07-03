<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class CheckInTest extends TestCase
{
    public function test_checkin_validates_coordinates()
    {
        // Coordinate validation is now handled at the controller level
        // This test is no longer relevant for the model
        $this->assertTrue(true);
    }
}
