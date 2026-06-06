<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - Modul 5 (Versioning v1)
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {

    // 1. Route Auth (Dapat diakses secara publik tanpa token)
    Route::post('register', 'App\Http\Controllers\AuthController@register');
    Route::post('login', 'App\Http\Controllers\AuthController@login');

    // 2. Route yang membutuhkan Token Autentikasi (Sanctum Middleware)
    Route::middleware('auth:sanctum')->group(function () {

        // Route untuk Categories (Resource tanpa Destroy)
        Route::apiResource('categories', 'App\Http\Controllers\CategoryController')->except(['destroy']);
        
        // Route khusus untuk Delete Category (Hanya boleh diakses oleh Admin)
        Route::delete('categories/{category}', 'App\Http\Controllers\CategoryController@destroy')->middleware('role:admin');

        // Route untuk Items (Resource tanpa Destroy)
        Route::apiResource('items', 'App\Http\Controllers\ItemController')->except(['destroy']);
        
        // Route khusus untuk Delete Item (Hanya boleh diakses oleh Admin)
        Route::delete('items/{item}', 'App\Http\Controllers\ItemController@destroy')->middleware('role:admin');
    });
});