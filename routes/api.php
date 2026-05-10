<?php

use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\HotelRoomController; 
use Illuminate\Support\Facades\Route;

Route::apiResource('room-types', RoomTypeController::class);
Route::apiResource('hotel-rooms', HotelRoomController::class); 