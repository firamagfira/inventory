<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index() {
        // Kita pakai 'with' supaya data kategorinya ikut muncul
        return response()->json(Item::with('category')->get());
    }

    public function store(Request $request) {
        $item = Item::create($request->all());
        return response()->json($item, 201);
    }

    public function show(Item $item) {
        return response()->json($item->load('category'));
    }

    public function update(Request $request, Item $item) {
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy(Item $item) {
        $item->delete();
        return response()->json(['message' => 'Item deleted']);
    }
}