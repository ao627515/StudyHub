<?php

namespace App\Http\Controllers;

use App\Models\CourseModule;
use App\Models\AcademicProgramLevel;
use Illuminate\Support\Facades\Auth;
use App\Services\CourseModuleService;
use App\Http\Requests\StoreCourseModuleRequest;
use App\Http\Requests\UpdateCourseModuleRequest;

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
    public function index()
    {
        $modules = $this->courseModuleService
            ->index(relations: [
                'createdBy',
                'academicProgramLevel.academicProgram.university',
                'academicProgramLevel.academicLevel'
            ]);

        $academicProgramLevels = AcademicProgramLevel::with(['academicProgram', 'academicLevel'])
            ->when(Auth::user()->isUploader(), function ($query) {
                return $query->where('academic_program_id',  Auth::user()->authUserSpecialisation()->academicProgram->id);
            })
            ->latest()->get();


        return view('admin.course_modules.index', compact('modules', 'academicProgramLevels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseModuleRequest $request)
    {
        $this->courseModuleService->store($request->validated());
        return to_route('admin.course_modules.index')->with('success', 'Module created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseModuleRequest $request, CourseModule $courseModule)
    {
        $this->courseModuleService->update($courseModule, $request->validated());
        return to_route('admin.course_modules.index')->with('success', 'Module updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseModule $courseModule)
    {
        $this->courseModuleService->delete($courseModule);
        return to_route('admin.course_modules.index')->with('success', 'Module deleted successfully.');
    }
}
