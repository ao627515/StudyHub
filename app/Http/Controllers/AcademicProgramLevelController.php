<?php

namespace App\Http\Controllers;

use App\Models\Uploader;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\AcademicLevel;
use App\Models\AcademicProgram;
use App\Http\Controllers\Controller;
use App\Models\AcademicProgramLevel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Services\AcademicProgramLevelService;
use App\Http\Requests\AcademicProgramLevelRequest;

class AcademicProgramLevelController extends Controller
{
    private AcademicProgramLevelService $academicProgramLevel;

    public function __construct(AcademicProgramLevelService $academicProgramLevel)
    {
        $this->academicProgramLevel = $academicProgramLevel;
    }

    /**
     * Display a listing of academic levels.
     */
    public function index(): View
    {
        $programLevels = $this->academicProgramLevel->index();
        $programs = Auth::user()->isAdmin() ? AcademicLevel::latest()->get() : AcademicProgram::where('university_id', Uploader::find(Auth::id())->university->id)->get();
        $levels = AcademicLevel::latest()->get();

        return view(
            'admin.academic_program_levels.index',
            compact('programLevels', 'programs', 'levels')
        );
    }

    /**
     * Store a newly created academic level.
     */
    public function store(AcademicProgramLevelRequest $request): RedirectResponse
    {
        $this->academicProgramLevel->store($request->validated());
        return to_route('admin.academic_program_levels.index')->with('success', 'Academic Level created successfully.');
    }

    /**
     * Update the specified academic level.
     */
    public function update(AcademicProgramLevelRequest $request, AcademicProgramLevel $academicProgramLevel): RedirectResponse
    {
        $this->academicProgramLevel->update($academicProgramLevel, $request->validated());
        return to_route('admin.academic_program_levels.index')->with('success', 'Academic Level updated successfully.');
    }

    /**
     * Remove the specified academic level from storage.
     */
    public function destroy(AcademicProgramLeveL $academicProgramLevel): RedirectResponse
    {
        $this->academicProgramLevel->destroy($academicProgramLevel);
        return to_route('admin.academic_program_levels.index')->with('success', 'Academic Level deleted successfully.');
    }
}
