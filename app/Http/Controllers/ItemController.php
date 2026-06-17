<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Menampilkan daftar barang (Skenario Soal 5a, 5b, 5c)
     */
    public function index(Request $request)
    {
        // 1. Ambil query parameter 'category_id' dari URL (?category_id=...)
        $categoryId = $request->query('category_id');

        // 2. Buat query dasar untuk mengambil data dari tabel items
        $query = Item::query();

        // 3. Jika di Postman parameter category_id diisi/dicentang, lakukan filter
        if ($request->filled('category_id')) {
            $query->where('category_id', $categoryId);
        }

        // 4. Ambil hasil datanya
        $items = $query->get();

        // 5. Kembalikan response JSON sukses (Status 200 OK) dengan wrapper konsisten
        return response()->json([
            'success' => true,
            'message' => 'Daftar barang berhasil diambil',
            'data' => $items
        ], 200);
    }

    /**
     * Fungsi CRUD lainnya (bisa dikosongkan atau biarkan bawaan proyekmu)
     */
    public function store(Request $request) {}
    public function show($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
}