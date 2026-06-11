<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController; // Bersih tanpa v1
use App\Http\Controllers\Api\ItemController; // Bersih tanpa v1

/*
|--------------------------------------------------------------------------
| API Routes (Tanpa Folder v1)
|--------------------------------------------------------------------------
*/

// Rute Publik langsung tanpa bungkus prefix v1
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rute Terproteksi token untuk barang/items
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/items', [ItemController::class, 'index']);       // Tampilkan Semua Data
    Route::post('/items', [ItemController::class, 'store']);      // Tambah Data (Tugas 1)
    Route::put('/items/{id}', [ItemController::class, 'update']);  // Ubah Data (Tugas 1 - PUT)
    Route::delete('/items/{id}', [ItemController::class, 'destroy']); // Hapus Data (Tugas 2 - Khusus Admin)
});

// Pengaman otomatis jika lupa bawa token di Postman
Route::get('/login', function () {
    return response()->json([
        'success' => false,
        'message' => 'Unauthenticated. Silakan login dulu di POST /api/login untuk mengambil token.'
    ], 401);
})->name('login');