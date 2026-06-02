<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route Publik (Bisa diakses tanpa login/token)
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Route Terproteksi (Wajib membawa Token Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    
    // Mengambil data user yang sedang aktif login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Jalur resource categories (fungsi destroy/hapus dikecualikan)
    Route::apiResource('categories', 'App\Http\Controllers\CategoryController')->except(['destroy']);
    // Khusus jalur DELETE categories ini dikunci pakai tameng role:admin
    Route::delete('categories/{category}', 'App\Http\Controllers\CategoryController@destroy')->middleware('role:admin');

    // Jalur resource items (fungsi destroy/hapus dikecualikan)
    Route::apiResource('items', 'App\Http\Controllers\ItemController')->except(['destroy']);
    // Khusus jalur DELETE items ini dikunci pakai tameng role:admin
    Route::delete('items/{item}', 'App\Http\Controllers\ItemController@destroy')->middleware('role:admin');
    
});