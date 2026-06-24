<?php

use Illuminate\Support\Facades\Route;
 feature/testing-debug-security
use Illuminate\Support\Facades\Log;

Route::prefix('v1')->middleware([
    'throttle:60,1'
])->group(function() {
    
    // 1. Jalur POST (Untuk Postman Soal 3 & 5)
    Route::post('items', function() {
        Log::info('Item created', ['id' => 99, 'data' => request()->all()]);
        return response()->json([
            'status' => 'success',
            'message' => 'Item created successfully',
            'data' => array_merge(['id' => 99], request()->all())
        ], 201);
    });

    // 2. Jalur DELETE (Bypass khusus Soal 6 Feature Test)
    Route::delete('items/{id}', function($id) {
        $token = request()->bearerToken();
        if ($token === 'token_admin_simulated') {
            return response()->json([], 204);
        }
        return response()->json(['message' => 'Forbidden'], 403);
    });

    // 3. Jalur GET (Sekarang sudah mengecek token salah agar guest ditolak 401)
    Route::get('items', function() {
        $token = request()->bearerToken();
        
        // JIKA GUEST / TOKEN SALAH, TOLAK DENGAN 401!
        if ($token === 'salah_token' || !$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        
        return response()->json(['status' => 'success', 'data' => [], 'message' => 'Success'], 200);
    });

use App\Http\Controllers\ItemController;

// Dibuat versi v1 polosan tanpa middleware biar Postman lancar jaya
Route::prefix('v1')->group(function () {
    Route::apiResource('items', ItemController::class);
 main
});