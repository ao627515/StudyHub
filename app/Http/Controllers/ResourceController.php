<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Resource;
use App\Models\Uploader;
use App\Models\University;
use App\Models\CourseModule;
use App\Models\AcademicLevel;
use App\Models\CategoryResource;
use App\Services\ResourceService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreResourceRequest;
use App\Http\Requests\UpdateResourceRequest;
use App\Models\Administrator;
use App\Models\Moderator;

class ResourceController extends Controller
{
    protected $resourceService;

    public function __construct(ResourceService $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $params = [
            'paginate' => request('paginate', 10),
            'relations' => request('relations', []),
            'university' => request('university', 0),
            'program' => request('program', 0),
            'level' => request('level', 0),
            'category' => request('category', 0),
            'name' => request('name', ''),
            'module' => request('module', 0),
            'schoolYear' => request('schoolYear', 0)
        ];
        $resources = $this->resourceService->index($params);
        return view('admin.resources.index', compact('resources'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /**
         * @var Administrator|Moderator|Uploader|User $authUser
         */
        $authUser = Auth::user()->authUserSpecialisation();

        // Extraction des IDs nécessaires en une seule ligne
        if ($authUser->isUploader()) {
            $authUserAcademicProgramId = $authUser->academicProgramLevel->academicProgram->id ?? null;
            $authUserUniversityId = $authUser->university->id ?? null;
            $authUserAcademicLevelId = $authUser->academicLevel->id ?? null;
        }

        $schoolYears = $this->generateSchoolYears();

        $courseModulesQuery = CourseModule::latest();

        // Filtrage des modules de cours si l'utilisateur est un uploader
        if ($authUser->isUploader()) {
            $courseModulesQuery->whereHas('academicProgramLevel', function ($query) use ($authUserAcademicProgramId, $authUserUniversityId, $authUserAcademicLevelId) {
                $query->whereHas('academicProgram', function ($query) use ($authUserAcademicProgramId, $authUserUniversityId) {
                    $query->where('id', $authUserAcademicProgramId)
                        ->where('university_id', $authUserUniversityId);
                })->whereHas('academicLevel', function ($query) use ($authUserAcademicLevelId) {
                    $query->where('id', $authUserAcademicLevelId);
                });
            });
        }



        $courseModules = $courseModulesQuery->get();
        if (!$authUser->isUploader())
            $courseModules->load('academicProgramLevel.academicProgram.university');

        $categories = CategoryResource::latest()->get();

        return view('admin.resources.create', compact("courseModules", "categories", "schoolYears"));
    }

    /**
     * Génère les années scolaires sous forme de chaînes "YYYY-YYYY" pour les 10 dernières années.
     */
    private function generateSchoolYears($years = 10)
    {
        $schoolYears = [];
        $currentYear = date('Y');
        for ($i = 0; $i < $years; $i++) {
            $schoolYears[] = ($currentYear - 1) . "-$currentYear";
            $currentYear--;
        }
        return $schoolYears;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResourceRequest $request)
    {
        $resource = $this->resourceService->store($request->validated());
        return redirect()->route('admin.resources.index')->with('success', 'Resource created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        return view('admin.resources.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource)
    {
        /**
         * @var Administrator|Moderator|Uploader|User $authUser
         */
        $authUser = Auth::user()->authUserSpecialisation();

        // Extraction des IDs nécessaires en une seule ligne
        if ($authUser->isUploader()) {
            $authUserAcademicProgramId = $authUser->academicProgramLevel->academicProgram->id ?? null;
            $authUserUniversityId = $authUser->university->id ?? null;
            $authUserAcademicLevelId = $authUser->academicLevel->id ?? null;
        }

        $schoolYears = $this->generateSchoolYears();

        $courseModulesQuery = CourseModule::latest();

        // Filtrage des modules de cours si l'utilisateur est un uploader
        if ($authUser->isUploader()) {
            $courseModulesQuery->whereHas('academicProgramLevel', function ($query) use ($authUserAcademicProgramId, $authUserUniversityId, $authUserAcademicLevelId) {
                $query->whereHas('academicProgram', function ($query) use ($authUserAcademicProgramId, $authUserUniversityId) {
                    $query->where('id', $authUserAcademicProgramId)
                        ->where('university_id', $authUserUniversityId);
                })->whereHas('academicLevel', function ($query) use ($authUserAcademicLevelId) {
                    $query->where('id', $authUserAcademicLevelId);
                });
            });
        }



        $courseModules = $courseModulesQuery->get();
        if (!$authUser->isUploader())
            $courseModules->load('academicProgramLevel.academicProgram.university');

        $categories = CategoryResource::latest()->get();

        return view('admin.resources.edit', compact('resource', "courseModules", "categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResourceRequest $request, Resource $resource)
    {
        $this->resourceService->update($resource, $request->validated());
        return redirect()->route('admin.resources.index')->with('success', 'Resource updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        $this->resourceService->destroy($resource);
        return redirect()->route('admin.resources.index')->with('success', 'Resource deleted successfully.');
    }

    public function downloadFile(Resource $resource)
    {

        $filePath = $this->resourceService->downloadFile($resource);

        // Télécharge le fichier
        return response()->download($filePath);
    }
}
