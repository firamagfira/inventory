<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController; // Hubungkan ke BaseController

class ItemController extends BaseController // Ubah extend ke BaseController
{
    // 1. Ambil Semua Data Barang (Untuk Soal 6c)
    public function index()
    {
        $items = Item::all();
        return $this->success($items, 'Items retrieved successfully.');
    }

    // 2. Tambah Barang Baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first(), 400);
        }

        $item = Item::create($request->all());
        return $this->success($item, 'Item created successfully.', 201);
    }

    // 3. Update Data Barang
    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        if (!$item) {
            return $this->error('Item not found.', 404);
        }

        $item->update($request->all());
        return $this->success($item, 'Item updated successfully.');
    }

    // 4. Hapus Barang (Untuk Soal 6d & 6e - Proteksi Middleware Admin)
    public function destroy($id)
    {
        // Cek dulu apakah user yang login rolenya admin (Sesuai Soal 6d & 6e)
        if (auth()->user()->role !== 'admin') {
            return $this->error('Forbidden. Hanya admin yang boleh menghapus data!', 403);
        }

        $item = Item::find($id);
        if (!$item) {
            return $this->error('Item not found.', 404);
        }

        $item->delete();
        return $this->success(null, 'Item deleted successfully.');
    }
}