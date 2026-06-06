<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Services\ItemService;
use App\Http\Controllers\Api\BaseController;
use Exception;

class ItemController extends BaseController
{
    protected $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function index()
    {
        $items = $this->itemService->all();
        return $this->success($items, "Daftar item berhasil ditampilkan.");
    }

    public function store(StoreItemRequest $request)
    {
        $item = $this->itemService->create($request->validated());
        return $this->success($item, "Item berhasil dibuat.", 201);
    }

    public function show($id)
    {
        try {
            $item = $this->itemService->find($id);
            return $this->success($item, "Detail item berhasil ditampilkan.");
        } catch (Exception $e) {
            return $this->error("Item tidak ditemukan.", 404);
        }
    }

    public function update(UpdateItemRequest $request, $id)
    {
        try {
            $item = $this->itemService->update($id, $request->validated());
            return $this->success($item, "Item berhasil diperbarui.");
        } catch (Exception $e) {
            return $this->error("Gagal memperbarui item. Data tidak ditemukan.", 404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->itemService->delete($id);
            return $this->success(null, "Item berhasil dihapus.", 200);
        } catch (Exception $e) {
            return $this->error("Gagal menghapus item. Data tidak ditemukan.", 404);
        }
    }
}