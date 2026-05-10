<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    // Menampilkan semua tipe kamar
    public function index()
    {
        return response()->json(RoomType::all(), 200);
    }

    // Menambah tipe kamar baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'base_price' => 'required|integer',
        ]);

        $roomType = RoomType::create($validated);
        return response()->json([
            'message' => 'Tipe kamar berhasil ditambahkan!',
            'data' => $roomType
        ], 201);
    }

    // Menampilkan detail satu tipe kamar
    public function show($id)
    {
        $roomType = RoomType::find($id);
        if (!$roomType) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($roomType, 200);
    }

    // Menghapus tipe kamar
    public function destroy($id)
    {
        $roomType = RoomType::find($id);
        if ($roomType) {
            $roomType->delete();
            return response()->json(['message' => 'Berhasil dihapus'], 200);
        }
        return response()->json(['message' => 'Gagal menghapus, data tidak ada'], 404);
    }
}