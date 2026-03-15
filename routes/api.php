<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('/reservations', ReservationController::class)->middleware('auth:sanctum');
Route::patch('/reservations/{id}/status', [ReservationController::class, 'changeStatus'])->middleware('auth:sanctum');
Route::put('/reservations/{id}/cancel', [ReservationController::class, 'annuleReservation'])->middleware('auth:sanctum');

    
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::middleware(['auth:sanctum', 'admin'])->get('/admin/dashboard', [AdminController::class, 'dashboard']);

