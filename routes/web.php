<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckInController;

Route::get('/', fn() => view('index'));

# Check-In Routes
Route::post('/check-ins', [CheckInController::class, 'store']);
Route::put('/check-ins/{checkIn}', [CheckInController::class, 'update']);
Route::post('/check-ins/{checkIn}', [CheckInController::class, 'update']); // For FormData with _method=PUT
Route::delete('/check-ins/{checkIn}', [CheckInController::class, 'destroy']);
Route::get('/check-ins', [CheckInController::class, 'index']);
Route::get('/check-ins/{checkIn}', [CheckInController::class, 'show']);