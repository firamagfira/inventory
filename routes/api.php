<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/identitas', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Data Mahasiswa Berhasil Diambil',
        'data' => [
            'nama' => 'Maghfirah',
            'nim'  => '60200124112',
            'kelas' => 'Teknik informatika',
            'tugas' => 'Praktikum Web Service - Nomor 3'
        ]
    ], 200);
});


