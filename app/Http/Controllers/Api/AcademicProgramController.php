<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AcademicProgram;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAcademicProgramRequest;
use App\Http\Requests\UpdateAcademicProgramRequest;
use App\Http\Resources\AcademicProgramCollection;
use App\Http\Resources\AcademicProgramResource;
use App\Http\Resources\ResponseResource;
use App\Http\Resources\ErrorResponseResource;
use App\Services\AcademicProgramService;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class AcademicProgramController extends Controller
{
    private AcademicProgramService $academicProgramService;

    public function __construct(AcademicProgramService $academicProgramService)
    {
        $this->academicProgramService = $academicProgramService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $programs = $this->academicProgramService->getAll();

            return new ResponseResource(
                data: new AcademicProgramCollection(new AcademicProgramCollection($programs)),
                message: 'Academic programs retrieved successfully'
            );
        } catch (Exception $ex) {
            return (new ErrorResponseResource(
                message: 'Failed to retrieve academic programs',
                errors: ['exception' => $ex->getMessage()]
            ))->response()->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAcademicProgramRequest $request)
    {
        try {
            $attributes = $request->validated();

            $program = $this->academicProgramService->create($attributes);

            return new ResponseResource(
                data: new AcademicProgramResource(
                    new AcademicProgramResource($program)
                ),
                message: 'Academic program created successfully'
            );
        } catch (Exception $ex) {
            return (new ErrorResponseResource(
                message: 'Failed to create academic program',
                errors: ['exception' => $ex->getMessage()]
            ))->response()->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAcademicProgramRequest $request, AcademicProgram $academicProgram)
    {
        try {
            $attributes = $request->validated();

            $program = $this->academicProgramService->update($academicProgram, $attributes);

            return new ResponseResource(
                data: new AcademicProgramResource(new AcademicProgramResource($program)),
                message: 'Academic program updated successfully'
            );
        } catch (Exception $ex) {
            return (new ErrorResponseResource(
                message: 'Failed to update academic program',
                errors: ['exception' => $ex->getMessage()]
            ))->response()->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicProgram $academicProgram)
    {
        try {
            $this->academicProgramService->delete($academicProgram);

            return new ResponseResource(
                data: null,
                message: 'Academic program deleted successfully'
            );
        } catch (Exception $ex) {
            return (new ErrorResponseResource(
                message: 'Failed to delete academic program',
                errors: ['exception' => $ex->getMessage(), 'validation' => null]
            ))->response()->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
