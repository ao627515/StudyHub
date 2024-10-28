<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AcademicLevelResource;
use Exception;
use App\Models\AcademicLevel;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\AcademicLevelService;
use App\Http\Resources\ResponseResource;
use App\Http\Resources\ErrorResponseResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\AcademicLevelCollection;
use App\Http\Requests\StoreAcademicLevelRequest;
use App\Http\Requests\UpdateAcademicLevelRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AcademicLevelController extends Controller
{
    private AcademicLevelService $academicLevelService;

    public function __construct(AcademicLevelService $academicLevelService)
    {
        $this->academicLevelService = $academicLevelService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->handleRequest(function () {
            $academicLevels = $this->academicLevelService->index();
            return new ResponseResource('Academic levels retrieved successfully', new AcademicLevelCollection($academicLevels));
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAcademicLevelRequest $request): JsonResponse
    {
        return $this->handleRequest(function () use ($request) {
            $attributes = $request->validated();
            $academicLevel = $this->academicLevelService->store($attributes);
            return new ResponseResource('Academic level created successfully', new AcademicLevelResource($academicLevel));
        }, Response::HTTP_CREATED);
    }

    public function show(int $academicLevelId)
    {
        return $this->handleRequest(function () use ($academicLevelId) {
            $academicLevel = $this->academicLevelService->show($academicLevelId);
            return new ResponseResource('Academic level retrieved successfully', new AcademicLevelResource($academicLevel));
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAcademicLevelRequest $request, int $academicLevelId): JsonResponse
    {
        return $this->handleRequest(function () use ($request, $academicLevelId) {
            $attributes = $request->validated();
            $updatedAcademicLevel = $this->academicLevelService->update($academicLevelId, $attributes);
            return new ResponseResource('Academic level updated successfully', new AcademicLevelResource($updatedAcademicLevel));
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $academicLevelId): JsonResponse
    {
        return $this->handleRequest(function () use ($academicLevelId) {
            $this->academicLevelService->destroy($academicLevelId);
            return new ResponseResource('Academic level deleted successfully', null);
        });
    }

    /**
     * Centralized error handling for all requests in this controller.
     */
    private function handleRequest(callable $callback, int $status = Response::HTTP_OK): JsonResponse
    {
        try {
            return response()->json(data: $callback(), status: $status);
        } catch (Exception $ex) {
            return (new ErrorResponseResource('An error occurred', ['exception' => $ex->getMessage()]))
                ->response()->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (ModelNotFoundException $ex) {
            return (new ErrorResponseResource('Academic level not found', ['exception' => $ex->getMessage()]))
                ->response()->setStatusCode(Response::HTTP_NOT_FOUND);
        }
    }
}