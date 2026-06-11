<?php

namespace App\Http\Controllers\Api; // <-- PASTI KAN BERSIH TANPA v1

use App\Http\Controllers\Controller;
use App\Models\Item; // <-- Pastikan model Item kamu sudah benar nama filenya
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    // 1. TAMPILKAN SEMUA BARANG
    public function index()
    {
        $items = Item::all();
        return response()->json([
            'success' => true,
            'data' => $items
        ], 200);
    }

    // 2. TAMBAH BARANG (TUGAS 1)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $item = Item::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil ditambahkan!',
            'data' => $item
        ], 201);
    }

    // 3. UBAH BARANG (TUGAS 1 - PUT)
    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Barang tidak ditemukan.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $item->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil diubah!',
            'data' => $item
        ], 200);
    }

    // 4. HAPUS BARANG (TUGAS 2 - OTORISASI ADMIN)
    public function destroy($id)
    {
        // Cek apakah yang login adalah admin
        if (auth()->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak! Hanya Admin yang boleh menghapus barang.'
            ], 403);
        }

        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Barang tidak ditemukan.'
            ], 404);
        }

        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil dihapus oleh Admin!'
        ], 200);
    }
}