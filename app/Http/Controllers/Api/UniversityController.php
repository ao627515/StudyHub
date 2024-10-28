<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\University;
use Illuminate\Http\JsonResponse;
use App\Services\UniversityService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseResource;
use App\Http\Resources\UniversityResource;
use App\Http\Resources\UniversityCollection;
use App\Http\Requests\StoreUniversityRequest;
use App\Http\Resources\ErrorResponseResource;
use App\Http\Requests\UpdateUniversityRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
    public function index(): JsonResponse
    {
        return $this->handleRequest(function () {
            $relations = request('relations', []);
            $paginate = request('paginate', 0);
            $universities = $this->universityService->getAll(paginate: $paginate, relations: $relations);

            return new ResponseResource('Universities retrieved successfully', new UniversityCollection($universities));
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUniversityRequest $request): JsonResponse
    {
        return $this->handleRequest(function () use ($request) {
            $attributes = $request->validated();
            $university = $this->universityService->create($attributes);

            return new ResponseResource('University created successfully', new UniversityResource($university));
        }, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        return $this->handleRequest(function () use ($id) {
            $relations = request('relations', []);
            $university = $this->universityService->getUniversity(universityId: $id, relations: $relations);

            return new ResponseResource('University retrieved successfully', new UniversityResource($university));
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUniversityRequest $request, University $university): JsonResponse
    {
        return $this->handleRequest(function () use ($request, $university) {
            $attributes = $request->validated();
            $updatedUniversity = $this->universityService->update($university, $attributes);

            return new ResponseResource('University updated successfully', new UniversityResource($updatedUniversity));
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(University $university): JsonResponse
    {
        return $this->handleRequest(function () use ($university) {
            $this->universityService->delete($university);

            return new ResponseResource('University deleted successfully', null);
        });
    }

    /**
     * Centralized error handling for all requests in this controller.
     */
    private function handleRequest(callable $callback, int $status = Response::HTTP_OK): JsonResponse
    {
        try {
            return response()->json(data: $callback(), status: $status);
        } catch (ModelNotFoundException $ex) {
            return (new ErrorResponseResource('University not found', ['exception' => $ex->getMessage()]))
                ->response()->setStatusCode(Response::HTTP_NOT_FOUND);
        } catch (Exception $ex) {
            return (new ErrorResponseResource('An error occurred', ['exception' => $ex->getMessage()]))
                ->response()->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}