<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Menampilkan daftar barang (Skenario Soal 5a, 5b, 5c + Perbaikan Reviewer)
     */
    public function index(Request $request)
    {
        // 1. Buat query dasar untuk mengambil data dari tabel items (menggunakan with('category') sesuai Modul 6)
        $query = Item::with('category');

        // 2. Jika parameter category_id diisi DAN lolos validasi berupa angka (is_numeric) -> Hasil Perbaikan Langkah 2
        if ($request->filled('category_id') && is_numeric($request->category_id)) {
            $query->where('category_id', $request->category_id);
        }

        // 3. Ambil hasil datanya
        $items = $query->get();

        // 4. Kembalikan response JSON sukses (Status 200 OK) dengan wrapper konsisten sesuai Soal 5
        return response()->json([
            'success' => true,
            'message' => 'Daftar barang berhasil diambil',
            'data' => $items
        ], 200);
    }

    /**
     * Fungsi CRUD lainnya
     */
    public function store(Request $request) {}
    
    public function show($id) {}
    
    public function update(Request $request, $id) {}
    
    public function destroy($id) {}
} // <- Pastikan kurung kurawal penutup class ini ada di paling bawah file!