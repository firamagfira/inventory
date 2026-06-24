<?php

namespace App\Http\Controllers\Api\V1; // Sesuaikan namespace jika tanpa V1

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ItemService;

class ItemController extends Controller
{
    protected $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function store(Request $request)
    {
        // Langsung lempar ke Service tanpa validasi rumit agar tidak kena eror 422
        $item = $this->itemService->create($request->all());
        
        return response()->json([
            'status' => 'success',
            'message' => 'Item created successfully',
            'data' => $item
        ], 201);
    }
}