<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginateSectorRequest;
use App\Http\Requests\SectorRequest;
use App\Http\Resources\PaginateSectorResource;
use App\Http\Resources\SectorResource;
use App\Models\Sector;
use App\Services\SectorServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SectorController extends Controller
{
    protected $service;

    /**
     * Method __construct
     *
     * @param SectorServiceInterface $service
     *
     * @return void
     */
    public function __construct(SectorServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *      tags={"sectors"},
     *      summary="Lista de setores",
     *      description="Retorna uma coleção de setores",
     *      path="/api/sectors",
     *      security={{"bearerAuth"={}}},
     *      @OA\Parameter (ref="#/components/parameters/search"),
     *      @OA\Parameter (ref="#/components/parameters/limit"),
     *      @OA\Parameter (ref="#/components/parameters/page"),
     *      @OA\Parameter (ref="#/components/parameters/orderBy"),
     *      @OA\Parameter (ref="#/components/parameters/sortedBy"),
     *      @OA\Response(
     *      response="200",
     *      description="Uma lista de setores",
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
    public function index(PaginateSectorRequest $request)
    {
        $dataValidated = $request->validated();
        return PaginateSectorResource::collection($this->service->paginate($dataValidated));
    }

    /**
     * @OA\Post (
     *     tags={"sectors"},
     *     summary="Cadastrar um setor",
     *     description="Retorna Ok se o setor for criado",
     *     path="/api/sectors",
     *     security={{"bearerAuth"={}}},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#components/schemas/SectorRequest"),
     *      ),
     *     @OA\Response(response="201", description="Setor cadastrado com sucesso."),
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
    public function store(SectorRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->service->store($data);
        return response()->json(null, 201);
    }

    /**
     * @OA\Get(
     *      tags={"sectors"},
     *      summary="Exibe um setor",
     *      description="Retorna um setor",
     *      path="/api/sectors/{sector_id}",
     *      security={{"bearerAuth"={}}},
     *      @OA\Parameter(ref="#components/parameters/sector_id"),
     *      @OA\Response(
     *          response="200",
     *          description="Objeto feriado",
     *          @OA\JsonContent(ref="#/components/schemas/Sector"),
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
    public function show(SectorRequest $request, Sector $sector): JsonResponse
    {
        return response()->json(new SectorResource($this->service->find($sector)));
    }

    /**
     * @OA\Put (
     *     tags={"sectors"},
     *     summary="Altera um setor",
     *     description="Atualiza o setor e retorna o Modelo",
     *     path="/api/sectors/{sector_id}",
     *     security={{"bearerAuth"={}}},
     *     @OA\Parameter(ref="#components/parameters/sector_id"),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#components/schemas/SectorRequest"),
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="Objeto atualizado",
     *          @OA\JsonContent(ref="#/components/schemas/Sector"),
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
    public function update(SectorRequest $request, Sector $sector): JsonResponse
    {
        $dataValidated = $request->validated();
        $product = $this->service->update($dataValidated, $sector);
        return response()->json(new SectorResource($product));
    }

    /**
     * @OA\Delete (
     *      tags={"sectors"},
     *      summary="Exclui um setor",
     *      description="Retorna ok se o setor foi deletado",
     *      path="/api/sectors/{sectors_id}",
     *      security={{"bearerAuth"={}}},
     *      @OA\Parameter(ref="#components/parameters/sectors_id"),
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
    public function destroy(SectorRequest $request, Sector $sector): Response
    {
        $this->service->delete($sector);
        return response(null, 204);
    }

}
