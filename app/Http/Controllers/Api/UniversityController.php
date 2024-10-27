<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ErrorResponseResource;
use App\Http\Resources\ResponseResource;
use Exception;
use App\Models\University;
use Illuminate\Http\Request;
use App\Services\UniversityService;
use App\Http\Controllers\Controller;
use App\Http\Resources\UniversityResource;
use App\Http\Resources\UniversityCollection;
use App\Http\Requests\StoreUniversityRequest;
use App\Http\Requests\UpdateUniversityRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class UniversityController extends Controller
{
    private UniversityService $universityService;

    public function __construct(UniversityService $universityService)
    {
        $this->universityService = $universityService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $relations = [];

            if (request()->filled('relations')) {
                $relations = request('relations');
            }

            $universities = $this->universityService->getAll(relations: $relations);

            return new ResponseResource(message: 'Universities retrieved successfully', data: new UniversityCollection($universities));
        } catch (Exception $ex) {
            return (new ErrorResponseResource('Failed to retrieve universities', [
                'exception' => $ex->getMessage()
            ]))->response()->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUniversityRequest $request): JsonResponse
    {
        try {
            $attributes = $request->validated();
            $university = $this->universityService->create($attributes);

            return response()->json([
                'status' => 'success',
                'message' => 'University created successfully',
                'data' => new UniversityResource($university),
                'errors' => null
            ], Response::HTTP_CREATED); // 201 Created
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create university',
                'data' => null,
                'errors' => [
                    'exception' => $ex->getMessage()
                ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR); // 500 Internal Server Error
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUniversityRequest $request, University $university): JsonResponse
    {
        try {
            $attributes = $request->validated();
            $university = $this->universityService->update($university, $attributes);

            return response()->json([
                'status' => 'success',
                'message' => 'University updated successfully',
                'data' => new UniversityResource($university),
                'errors' => null
            ], Response::HTTP_OK); // 200 OK
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update university',
                'data' => null,
                'errors' => [
                    'exception' => $ex->getMessage()
                ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR); // 500 Internal Server Error
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(University $university): JsonResponse
    {
        try {
            $this->universityService->delete($university);

            return response()->json([
                'status' => 'success',
                'message' => 'University deleted successfully',
                'data' => null,
                'errors' => null
            ], Response::HTTP_OK); // 200 OK
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete university',
                'data' => null,
                'errors' => [
                    'exception' => $ex->getMessage()
                ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR); // 500 Internal Server Error
        }
    }
}
