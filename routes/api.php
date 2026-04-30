<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/tugas-praktikum', function () {
    return response()->json([
        'status'       => 'Berhasil',
        'nama'         => 'Maghfirah', 
        'nim'          => '60200124112',  
        'mata_kuliah'  => 'Praktikum Web 2',
        'keterangan'   => 'Tugas API Laravel Berhasil dijalankan'
    ]);
});


