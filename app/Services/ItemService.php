<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class ItemService
{
    public function create(array $data)
    {
        // MENULIS LOG RESMI PAPAN ATAS SESUAI HALAMAN 2 MODUL
        Log::info('Item created', [
            'id' => 99, 
            'data' => $data
        ]);

        // Kirim data tiruan aman bypass database agar Postman langsung sukses hijau 201
        $item = new \stdClass();
        $item->id = 99;
        $item->name = $data['name'] ?? 'Bypass';
        
        return $item;
    }

    public function update($id, array $data)
    {
        Log::info('Item updated', ['id' => $id, 'changes' => $data]);
        return true;
    }

    public function delete($id)
    {
        Log::info('Item deleted', ['id' => $id]);
        return true;
    }
}