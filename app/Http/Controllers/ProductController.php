<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginateProductRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\PaginateProductResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    protected $service;

    /**
     * Method __construct
     *
     * @param ProductServiceInterface $service
     *
     * @return void
     */
    public function __construct(ProductServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *      tags={"products"},
     *      summary="Lista de Produtos",
     *      description="Retorna uma coleção de produtos",
     *      path="/api/products",
     *      security={{"bearerAuth"={}}},
     *      @OA\Parameter (ref="#/components/parameters/search"),
     *      @OA\Parameter (ref="#/components/parameters/limit"),
     *      @OA\Parameter (ref="#/components/parameters/page"),
     *      @OA\Parameter (ref="#/components/parameters/orderBy"),
     *      @OA\Parameter (ref="#/components/parameters/sortedBy"),
     *      @OA\Response(
     *      response="200",
     *      description="Uma lista de produtos",
     *          @OA\JsonContent(
     *              @OA\Property (property="meta", ref="#components/schemas/pagination_meta")
     *          ),
     *      ),
     *      @OA\Response(response="401",ref="#/components/responses/unauth"),
     *      @OA\Response(response="403",ref="#/components/responses/forbidden"),
     *      @OA\Response(response="404", description="Não encontrado."),
     *      @OA\Response(response="500",ref="#/components/responses/oops"),
     * ),
     * This will suppress UnusedLocalVariable
     * warnings in this method
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function index(PaginateProductRequest $request)
    {
        $dataValidated = $request->validated();
        return PaginateProductResource::collection($this->service->paginate($dataValidated));
    }

    /**
     * @OA\Post (
     *     tags={"products"},
     *     summary="Cadastrar um produto",
     *     description="Retorna Ok se o produto for criado",
     *     path="/api/products",
     *     security={{"bearerAuth"={}}},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#components/schemas/ProductRequest"),
     *      ),
     *     @OA\Response(response="201", description="Produto cadastrado com sucesso."),
     *     @OA\Response(response="401",ref="#/components/responses/unauth"),
     *     @OA\Response(response="403",ref="#/components/responses/forbidden"),
     *     @OA\Response(response="422",ref="#/components/responses/invalid"),
     *     @OA\Response(response="500",ref="#/components/responses/oops"),
     * ),
     * This will suppress UnusedLocalVariable
     * warnings in this method
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function store(ProductRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->service->store($data);
        return response()->json(null, 201);
    }

    /**
     * @OA\Get(
     *      tags={"products"},
     *      summary="Exibe um produto",
     *      description="Retorna um produto",
     *      path="/api/products/{product_id}",
     *      security={{"bearerAuth"={}}},
     *      @OA\Parameter(ref="#components/parameters/holiday_id"),
     *      @OA\Response(
     *          response="200",
     *          description="Objeto feriado",
     *          @OA\JsonContent(ref="#/components/schemas/Holiday"),
     *     ),
     *      @OA\Response(response="403",ref="#/components/responses/forbidden"),
     *      @OA\Response(response="401",ref="#/components/responses/unauth"),
     *      @OA\Response(response="404", description="Não encontrado."),
     *      @OA\Response(response="500",ref="#/components/responses/oops"),
     * ),
     *
     * This will suppress UnusedLocalVariable
     * warnings in this method
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function show(ProductRequest $request, Product $product): JsonResponse
    {
        return response()->json(new ProductResource($this->service->find($product)));
    }

    /**
     * @OA\Put (
     *     tags={"products"},
     *     summary="Altera um produto",
     *     description="Atualiza o produto e retorna o Modelo",
     *     path="/api/products/{product_id}",
     *     security={{"bearerAuth"={}}},
     *     @OA\Parameter(ref="#components/parameters/product_id"),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#components/schemas/ProductRequest"),
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="Objeto atualizado",
     *          @OA\JsonContent(ref="#/components/schemas/Product"),
     *     ),
     *     @OA\Response(response="403",ref="#/components/responses/forbidden"),
     *     @OA\Response(response="401",ref="#/components/responses/unauth"),
     *     @OA\Response(response="404", description="Não encontrado."),
     *     @OA\Response(response="500",ref="#/components/responses/oops"),
     *     @OA\Response(response="422",ref="#/components/responses/invalid"),
     * ),
     * This will suppress UnusedLocalVariable
     * warnings in this method
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function update(ProductRequest $request, Product $product): JsonResponse
    {
        $dataValidated = $request->validated();
        $product = $this->service->update($dataValidated, $product);
        return response()->json(new ProductResource($product));
    }

    /**
     * @OA\Delete (
     *      tags={"products"},
     *      summary="Exclui um produto",
     *      description="Retorna ok se o produto foi deletado",
     *      path="/api/products/{product_id}",
     *      security={{"bearerAuth"={}}},
     *      @OA\Parameter(ref="#components/parameters/product_id"),
     *      @OA\Response(response="204",ref="#/components/responses/deleted"),
     *      @OA\Response(response="403",ref="#/components/responses/forbidden"),
     *      @OA\Response(response="404", description="Não encontrado."),
     *      @OA\Response(response="401",ref="#/components/responses/unauth"),
     *      @OA\Response(response="500",ref="#/components/responses/oops"),
     * ),
     *
     * This will suppress UnusedLocalVariable
     * warnings in this method
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function destroy(ProductRequest $request, Product $product): Response
    {
        $this->service->delete($product);
        return response(null, 204);
    }

}
