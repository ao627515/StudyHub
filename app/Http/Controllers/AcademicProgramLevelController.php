<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AcademicProgramLevel;
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
        $academicProgramLevels = $this->academicProgramLevel->index();
        return view('admin.academic_program_levels.index', compact('academicProgramLevels'));
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
