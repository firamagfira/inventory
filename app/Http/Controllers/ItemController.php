<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\ItemService; // WAJIB ADA: Menyambungkan Controller ke ItemService Tugas 1
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    protected $itemService;

    // Mengikat ItemService melalui Constructor (Refactor Service)
    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    // 1. FUNGSI TAMPILKAN DATA
    public function index()
    {
        $items = $this->itemService->getAllItems();
        return response()->json([
            'success' => true,
            'data' => $items
        ], 200);
    }

    // 2. FUNGSI TAMBAH DATA (Ada Request Validasi + Error Handling Try-Catch)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $item = $this->itemService->createItem($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Data item berhasil ditambahkan!',
                'data' => $item
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // 3. FUNGSI UBAH DATA (Fitur PUT Tugas 1)
    public function update(Request $request, $id)
    {
        $item = $this->itemService->updateItem($id, $request->all());

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Data item tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data item berhasil diubah!',
            'data' => $item
        ], 200);
    }

    // 4. FUNGSI HAPUS DATA (Tugas 2 - Proteksi Otorisasi Khusus Admin)
    public function destroy(Request $request, $id)
    {
        // Gerbang Otorisasi: Cek apakah user yang login rolenya beneran 'admin'
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak! Hanya user dengan hak akses Admin yang boleh menghapus data.'
            ], 403); // 403 Forbidden
        }

        // Jika dia admin, jalankan fungsi delete dari ItemService
        $deleted = $this->itemService->deleteItem($id);

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Data item tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data item berhasil dihapus oleh Admin!'
        ], 200);
    }
}