<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

// Dibuat versi v1 polosan tanpa middleware biar Postman lancar jaya
Route::prefix('v1')->group(function () {
    Route::apiResource('items', ItemController::class);
});