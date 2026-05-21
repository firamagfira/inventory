<?php
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;

Route::apiResource('room-types', RoomTypeController::class);
Route::apiResource('hotel-rooms', HotelRoomController::class);

// Tambahkan dua rute ini di bawahnya agar Postman bisa mengenali url /api/items dan /api/categories
Route::apiResource('items', ItemController::class);
Route::apiResource('categories', CategoryController::class);