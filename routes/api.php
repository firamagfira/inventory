<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;


Route::apiResource('categories', CategoryController::class);
Route::apiResource('items', ItemController::class);


