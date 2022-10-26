<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use App\Services\StoreServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class StoreController extends Controller
{
    protected $service;

    /**
     * Method __construct
     *
     * @param StoreServiceInterface $service
     *
     * @return void
     */
    public function __construct(StoreServiceInterface $service)
    {
        $this->service = $service;
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->service->store($data);
        return response()->json(null, 201);
    }

    public function show(StoreRequest $request, Store $store): JsonResponse
    {
        return response()->json(new StoreResource($this->service->find($store)));
    }

    public function destroy(StoreRequest $request, Store $store): Response
    {
        $this->service->delete($store);
        return response(null, 204);
    }

}
