<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Services\ItemService;
use Illuminate\Http\JsonResponse;

class ItemController extends Controller
{
    protected $svc;

    public function __construct(ItemService $service)
    {
        $this->svc = $service;
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->svc->all()
        ]);
    }

    public function store(StoreItemRequest $request): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->svc->create($request->validated())
        ], 201);
    }
}