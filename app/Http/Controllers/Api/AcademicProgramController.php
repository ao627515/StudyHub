<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AcademicProgram;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\AcademicProgramCollection;
use App\Http\Resources\AcademicProgramResource;
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

            return response()->json([
                'status' => 'success',
                'message' => 'Academic programs retrieved successfully',
                'data' => new AcademicProgramCollection($programs),
                'errors' => null
            ], Response::HTTP_OK);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve academic programs',
                'data' => null,
                'errors' => [
                    'exception' => $ex->getMessage()
                ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $attributes = $request->validate([
                'name' => 'required|string|max:255|unique:academic_programs,name',
                'abb' => 'nullable|string|max:20|unique:academic_programs,abb',
            ]);

            $program = $this->academicProgramService->create($attributes);

            return response()->json([
                'status' => 'success',
                'message' => 'Academic program created successfully',
                'data' => new AcademicProgramResource($program),
                'errors' => null
            ], Response::HTTP_CREATED);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create academic program',
                'data' => null,
                'errors' => [
                    'exception' => $ex->getMessage()
                ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademicProgram $academicProgram)
    {
        try {
            $attributes = $request->validate([
                'name' => 'required|string|max:255|unique:academic_programs,name,' . $academicProgram->id,
                'abb' => ['nullable', Rule::unique('academic_programs', 'abb')->ignore($academicProgram->id)],
            ]);

            $program = $this->academicProgramService->update($academicProgram, $attributes);

            return response()->json([
                'status' => 'success',
                'message' => 'Academic program updated successfully',
                'data' => new AcademicProgramResource($program),
                'errors' => null
            ], Response::HTTP_OK);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update academic program',
                'data' => null,
                'errors' => [
                    'exception' => $ex->getMessage()
                ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicProgram $academicProgram)
    {
        try {
            $this->academicProgramService->delete($academicProgram);

            return response()->json([
                'status' => 'success',
                'message' => 'Academic program deleted successfully',
                'data' => null,
                'errors' => null
            ], Response::HTTP_OK);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete academic program',
                'data' => null,
                'errors' => [
                    'exception' => $ex->getMessage()
                ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
