<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use App\Http\Controllers\Api\BaseController;
use Exception;

class CategoryController extends BaseController
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->all();
        return $this->success($categories, "Daftar kategori berhasil ditampilkan.");
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoryService->create($request->validated());
        return $this->success($category, "Kategori berhasil dibuat.", 201);
    }

    public function show($id)
    {
        try {
            $category = $this->categoryService->find($id);
            return $this->success($category, "Detail kategori berhasil ditampilkan.");
        } catch (Exception $e) {
            return $this->error("Kategori tidak ditemukan.", 404);
        }
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        try {
            $category = $this->categoryService->update($id, $request->validated());
            return $this->success($category, "Kategori berhasil diperbarui.");
        } catch (Exception $e) {
            return $this->error("Gagal memperbarui kategori. Data tidak ditemukan.", 404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->categoryService->delete($id);
            return $this->success(null, "Kategori berhasil dihapus.", 200);
        } catch (Exception $e) {
            return $this->error("Gagal menghapus kategori. Data tidak ditemukan.", 404);
        }
    }
}