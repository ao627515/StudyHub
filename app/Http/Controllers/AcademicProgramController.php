<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicProgram;
use Illuminate\Validation\Rule;
use App\Services\UniversityService;
use App\Services\AcademicProgramService;
use App\Http\Requests\StoreAcademicProgramRequest;

class AcademicProgramController extends Controller
{
    private AcademicProgramService $academicProgramService;
    private UniversityService  $universityService;

    public function __construct(AcademicProgramService $academicProgramService,  UniversityService  $universityService)
    {
        $this->academicProgramService = $academicProgramService;
        $this->universityService = $universityService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = $this->academicProgramService->getAll();
        $universities = $this->universityService->getAll();


        return view("admin.academic_programs.index", compact("programs", "universities"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.academic_programs.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAcademicProgramRequest $request)
    {
        // Validation des attributs
        $attributes = $request->validated();

        $this->academicProgramService->create($attributes);

        return to_route("admin.academic_programs.index")->with("success", "Programme académique créé avec succès !");
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicProgram $academicProgram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicProgram $academicProgram)
    {
        return view("admin.academic_programs.edit", compact("academicProgram"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademicProgram $academicProgram)
    {
        // Validation des attributs
        $attributes = $request->validate([
            'name' => 'required|string|max:255|unique:academic_programs,id',
            'abb' =>  ['nullable', Rule::unique('academic_programs', 'abb')->ignore($academicProgram->id)]
        ]);

        $this->academicProgramService->update($academicProgram, $attributes);

        return to_route("admin.academic_programs.index")->with("success", "Programme académique mis à jour avec succès !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicProgram $academicProgram)
    {
        $this->academicProgramService->delete($academicProgram);

        return to_route("admin.academic_programs.index")->with("success", "Programme académique supprimé avec succès !");
    }
}
