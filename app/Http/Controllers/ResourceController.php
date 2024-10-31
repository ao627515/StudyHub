<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\CourseModule;
use Illuminate\Http\Request;
use App\Services\ResourceService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreResourceRequest;
use App\Http\Requests\UpdateResourceRequest;
use App\Models\CategoryResource;
use App\Models\Uploader;
use App\Models\User;

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
        $resources = $this->resourceService->index(10); // Changez 10 si besoin
        return view('admin.resources.index', compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $authUploader = Uploader::find(Auth::id());
        $authUserAcademicProgramId  = $authUploader->academicProgramLevel->academicProgram->id;
        $authUserUniversityId = $authUploader->university->id;
        $authUserAcademicLevelId = $authUploader->academicLevel->id;
        // dump('authUserAcademicProgramId = ', $authUserAcademicProgramId);
        // dump('authUserUniversityId = ', $authUserUniversityId);
        // dump('authUserAcademicLevelId = ', $authUserAcademicLevelId);

        $courseModules = CourseModule::latest()->whereHas('academicProgramLevel', function ($query) use ($authUserAcademicProgramId, $authUserUniversityId, $authUserAcademicLevelId) {
            $query->whereHas('academicProgram', function ($query) use ($authUserAcademicProgramId, $authUserUniversityId) {
                $query->where('id', $authUserAcademicProgramId)
                    ->where('university_id', $authUserUniversityId);
            })
                ->whereHas('academicLevel', function ($query) use ($authUserAcademicLevelId) {
                    $query->where('id', $authUserAcademicLevelId);
                });
        })->get();

        // dd($courseModules);

        $categories = CategoryResource::latest()->get();

        return view('admin.resources.create', compact("courseModules", "categories"));
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
        return view('admin.resources.edit', compact('resource'));
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
}
