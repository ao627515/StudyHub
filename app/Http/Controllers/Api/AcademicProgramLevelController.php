<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\AcademicProgramLevel;
use App\Http\Resources\ResponseResource;
use App\Http\Resources\ErrorResponseResource;
use App\Services\AcademicProgramLevelService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\AcademicProgramLevelRequest;
use App\Http\Resources\AcademicProgramLevelResource;
use App\Http\Resources\AcademicProgramLevelCollection;
use App\Http\Requests\StoreAcademicProgramLevelRequest;
use App\Http\Requests\UpdateAcademicProgramLevelRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AcademicProgramLevelController extends Controller
{
    private AcademicProgramLevelService $academicProgramLevelService;

    public function __construct(AcademicProgramLevelService $academicProgramLevelService)
    {
        $this->academicProgramLevelService = $academicProgramLevelService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $relations = request('relations', []);
            $paginate = request('paginate', 0);
            $academicProgramLevels = $this->academicProgramLevelService->index(paginate: $paginate, relations: $relations);

            return response()->json(
                new ResponseResource('AcademicProgramLevels retrieved successfully', new AcademicProgramLevelCollection($academicProgramLevels)),
                Response::HTTP_OK
            );
        } catch (Exception $ex) {
            return response()->json(
                new ErrorResponseResource('An error occurred', ['exception' => $ex->getMessage()]),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AcademicProgramLevelRequest $request): JsonResponse
    {
        try {
            $attributes = $request->validated();
            $academicProgramLevel = $this->academicProgramLevelService->store($attributes);

            return response()->json(
                new ResponseResource('AcademicProgramLevel created successfully', new AcademicProgramLevelResource($academicProgramLevel)),
                Response::HTTP_CREATED
            );
        } catch (Exception $ex) {
            return response()->json(
                new ErrorResponseResource('An error occurred', ['exception' => $ex->getMessage()]),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicProgramLevel $id): JsonResponse
    {
        try {
            $relations = request('relations', []);
            $academicProgramLevel = $this->academicProgramLevelService->show(academicProgramLevel: $id, relations: $relations);

            return response()->json(
                new ResponseResource('AcademicProgramLevel retrieved successfully', new AcademicProgramLevelResource($academicProgramLevel)),
                Response::HTTP_OK
            );
        } catch (ModelNotFoundException $ex) {
            return response()->json(
                new ErrorResponseResource('AcademicProgramLevel not found', ['exception' => $ex->getMessage()]),
                Response::HTTP_NOT_FOUND
            );
        } catch (Exception $ex) {
            return response()->json(
                new ErrorResponseResource('An error occurred', ['exception' => $ex->getMessage()]),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AcademicProgramLevelRequest $request, AcademicProgramLevel $academicProgramLevel): JsonResponse
    {
        try {
            $attributes = $request->validated();
            $updatedAcademicProgramLevel = $this->academicProgramLevelService->update($academicProgramLevel, $attributes);

            return response()->json(
                new ResponseResource('AcademicProgramLevel updated successfully', new AcademicProgramLevelResource($updatedAcademicProgramLevel)),
                Response::HTTP_OK
            );
        } catch (Exception $ex) {
            return response()->json(
                new ErrorResponseResource('An error occurred', ['exception' => $ex->getMessage()]),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicProgramLevel $academicProgramLevel): JsonResponse
    {
        try {
            $this->academicProgramLevelService->destroy($academicProgramLevel);

            return response()->json(
                new ResponseResource('AcademicProgramLevel deleted successfully', null),
                Response::HTTP_OK
            );
        } catch (ModelNotFoundException $ex) {
            return response()->json(
                new ErrorResponseResource('AcademicProgramLevel not found', ['exception' => $ex->getMessage()]),
                Response::HTTP_NOT_FOUND
            );
        } catch (Exception $ex) {
            return response()->json(
                new ErrorResponseResource('An error occurred', ['exception' => $ex->getMessage()]),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}