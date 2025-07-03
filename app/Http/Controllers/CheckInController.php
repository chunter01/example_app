<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use Illuminate\Http\Request;
use App\Http\Resources\CheckInResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckInController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checkIns = CheckIn::latest()->simplePaginate(5);
        return CheckInResource::collection($checkIns);
    }

    /**
     * Display the specified resource.
     */
    public function show(CheckIn $checkIn): CheckInResource
    {
        return new CheckInResource($checkIn);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): CheckInResource
    {
        $request->validate([
            'description'  => 'required|string',
            'lat'          => 'required|nullable|numeric|between:-90,90',
            'lng'          => 'required|nullable|numeric|between:-180,180',
            'notes'        => 'nullable|string',
        ]);

        $checkIn = CheckIn::create([
            'description'  => $request->description,
            'lat'          => $request->lat,
            'lng'          => $request->lng,
            'notes'        => $request->notes,
        ]);

        return new CheckInResource($checkIn);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CheckIn $checkIn): CheckInResource
    {
        $request->validate([
            'description'  => 'required|string',
            'lat'          => 'required|nullable|numeric|between:-90,90',
            'lng'          => 'required|nullable|numeric|between:-180,180',
            'notes'        => 'nullable|string',
        ]);

        $checkIn->update([
            'description'  => $request->description,
            'lat'          => $request->lat,
            'lng'          => $request->lng,
            'notes'        => $request->notes,
        ]);

        return new CheckInResource($checkIn);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CheckIn $checkIn)
    {
        $checkIn->delete();

        return response()->json([
            'message' => 'Check-in deleted successfully.',
            'data'    => new JsonResource($checkIn)
        ]);
    }
}
