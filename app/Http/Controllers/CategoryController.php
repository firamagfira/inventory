<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    // Menghubungkan Controller dengan Service Layer
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    // 1. FUNGSI TAMPILKAN DATA (GET)
    public function index()
    {
        $categories = $this->categoryService->getAll();
        return response()->json(['status' => 'success', 'data' => $categories], 200);
    }

    // 2. FUNGSI TAMBAH DATA (POST) + Validasi & Error Handling
    public function store(StoreCategoryRequest $request)
    {
        try {
            $category = $this->categoryService->create($request->validated());
            return response()->json([
                'status' => 'success', 
                'message' => 'Kategori berhasil ditambahkan', 
                'data' => $category
            ], 21);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Gagal menambah data: ' . $e->getMessage()
            ], 500);
        }
    }

    // 3. FUNGSI UBAH DATA (PUT) + Error Handling
    public function update(Request $request, $id)
    {
        try {
            $category = $this->categoryService->update($id, $request->all());
            return response()->json([
                'status' => 'success', 
                'message' => 'Kategori berhasil diubah', 
                'data' => $category
            ], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan untuk diubah'], 404);
        }
    }

    // 4. FUNGSI HAPUS DATA (DELETE) + Error Handling
    public function destroy($id)
    {
        try {
            $this->categoryService->delete($id);
            return response()->json(['status' => 'success', 'message' => 'Kategori berhasil dihapus'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Data gagal dihapus atau tidak ditemukan'], 404);
        }
    }
}