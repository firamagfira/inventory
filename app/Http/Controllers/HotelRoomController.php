<?php

namespace App\Http\Controllers;

use App\Models\HotelRoom;
use Illuminate\Http\Request;

class HotelRoomController extends Controller
{
    public function index()
    {
        // Menampilkan semua kamar beserta info tipe kamarnya
        return response()->json(HotelRoom::with('roomType')->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_number' => 'required|unique:hotel_rooms',
            'floor' => 'required|integer',
            'room_type_id' => 'required|exists:room_types,id',
        ]);

        $room = HotelRoom::create($validated);
        return response()->json([
            'message' => 'Kamar berhasil didaftarkan!',
            'data' => $room
        ], 201);
    }
}