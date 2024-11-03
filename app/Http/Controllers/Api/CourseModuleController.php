<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\CourseModule;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\CourseModuleService;
use App\Http\Resources\ResponseResource;
use App\Http\Resources\CourseModuleResource;
use App\Http\Resources\ErrorResponseResource;
use App\Http\Resources\CourseModuleCollection;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreCourseModuleRequest;
use App\Http\Requests\UpdateCourseModuleRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CourseModuleController extends Controller
{
    private CourseModuleService $courseModuleService;

    public function __construct(CourseModuleService $courseModuleService)
    {
        $this->courseModuleService = $courseModuleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->handleRequest(function () {
            $relations = request('relations', []);
            $paginate = request('paginate', 0);
            $courseModules = $this->courseModuleService->index(paginate: $paginate, relations: $relations);

            return new ResponseResource('courseModules retrieved successfully', new CourseModuleCollection($courseModules));
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseModuleRequest $request): JsonResponse
    {
        return $this->handleRequest(function () use ($request) {
            $attributes = $request->validated();
            $courseModule = $this->courseModuleService->store($attributes);

            return new ResponseResource('CourseModule created successfully', new CourseModuleResource($courseModule));
        }, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        return $this->handleRequest(function () use ($id) {
            $relations = request('relations', []);
            $courseModule = $this->courseModuleService->show(courseModule: $id, relations: $relations);

            return new ResponseResource('CourseModule retrieved successfully', new CourseModuleResource($courseModule));
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseModuleRequest $request, CourseModule $courseModule): JsonResponse
    {
        return $this->handleRequest(function () use ($request, $courseModule) {
            $attributes = $request->validated();
            $updatedCourseModule = $this->courseModuleService->update($courseModule, $attributes);

            return new ResponseResource('CourseModule updated successfully', new CourseModuleResource($updatedCourseModule));
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseModule $courseModule): JsonResponse
    {
        return $this->handleRequest(function () use ($courseModule) {
            $this->courseModuleService->delete($courseModule);

            return new ResponseResource('CourseModule deleted successfully', null);
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
            return (new ErrorResponseResource('CourseModule not found', ['exception' => $ex->getMessage()]))
                ->response()->setStatusCode(Response::HTTP_NOT_FOUND);
        } catch (Exception $ex) {
            return (new ErrorResponseResource('An error occurred', ['exception' => $ex->getMessage()]))
                ->response()->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}