<?php

namespace App\Http\Controllers;

use App\Models\Uploader;
use Illuminate\Http\Request;
use App\Services\UploaderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UniversityService;

class UploaderController extends Controller
{
    private UploaderService $uploaderService;
    private UniversityService $universityService;

    public function __construct(UploaderService $uploaderService, UniversityService $universityService)
    {
        $this->uploaderService = $uploaderService;
        $this->universityService = $universityService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $uploaders = $this->uploaderService->getAll();

        return view("admin.uploaders.index", compact("uploaders"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Récupérez les données nécessaires pour le formulaire de création
        $universities = $this->universityService->getAll();
        $academicLevels = $this->uploaderService->getAcademicLevels();
        $academicPrograms = $this->uploaderService->getAcademicPrograms();

        return view("admin.uploaders.create", compact("universities", "academicLevels", "academicPrograms"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $attributes = $request->validated();

        $this->uploaderService->create($attributes);

        return to_route("admin.uploaders.index")->with("success", "Uploader créé avec succès !");
    }

    /**
     * Display the specified resource.
     */
    public function show(Uploader $uploader)
    {
        // Affichez les détails d'un uploader
        return view("admin.uploaders.show", compact("uploader"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Uploader $uploader)
    {
        // Récupérez les données nécessaires pour le formulaire d'édition
        $universities = $this->uploaderService->getUniversities();
        $academicLevels = $this->uploaderService->getAcademicLevels();
        $academicPrograms = $this->uploaderService->getAcademicPrograms();

        return view("admin.uploaders.edit", compact("uploader", "universities", "academicLevels", "academicPrograms"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, Uploader $uploader)
    {
        $attributes = $request->validated();

        // dd($attributes);

        $this->uploaderService->update($uploader, $attributes);

        return to_route("admin.uploaders.index")->with("success", "Uploader modifié avec succès !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Uploader $uploader)
    {
        $this->uploaderService->delete($uploader);

        return to_route("admin.uploaders.index")->with("success", "Uploader supprimé avec succès !");
    }
}