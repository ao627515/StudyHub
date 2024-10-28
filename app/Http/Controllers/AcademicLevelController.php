<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAcademicLevelRequest;
use App\Http\Requests\UpdateAcademicLevelRequest;
use App\Models\AcademicLevel;
use App\Services\AcademicLevelService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AcademicLevelController extends Controller
{
    private AcademicLevelService $academicLevelService;

    public function __construct(AcademicLevelService $academicLevelService)
    {
        $this->academicLevelService = $academicLevelService;
    }

    /**
     * Display a listing of academic levels.
     */
    public function index(): View
    {
        $academicLevels = $this->academicLevelService->index();
        return view('admin.academic_levels.index', compact('academicLevels'));
    }

    /**
     * Store a newly created academic level.
     */
    public function store(StoreAcademicLevelRequest $request): RedirectResponse
    {
        $this->academicLevelService->store($request->validated());
        return to_route('admin.academic_levels.index')->with('success', 'Academic Level created successfully.');
    }

    /**
     * Update the specified academic level.
     */
    public function update(UpdateAcademicLevelRequest $request, AcademicLevel $academicLevel): RedirectResponse
    {
        $this->academicLevelService->update($academicLevel, $request->validated());
        return to_route('admin.academic_levels.index')->with('success', 'Academic Level updated successfully.');
    }

    /**
     * Remove the specified academic level from storage.
     */
    public function destroy(AcademicLevel $academicLevel): RedirectResponse
    {
        $this->academicLevelService->destroy($academicLevel);
        return to_route('admin.academic_levels.index')->with('success', 'Academic Level deleted successfully.');
    }
}