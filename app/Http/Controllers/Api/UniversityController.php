<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\University;
use Illuminate\Http\Request;
use App\Services\UniversityService;
use App\Http\Controllers\Controller;
use App\Http\Resources\UniversityResource;
use App\Http\Resources\UniversityCollection;
use App\Http\Requests\StoreUniversityRequest;
use App\Http\Requests\UpdateUniversityRequest;

class UniversityController extends Controller
{

    private UniversityService $universityService;

    public function __construct(UniversityService $universityService)
    {
        $this->universityService = $universityService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $universities = $this->universityService->getAll();

            return new UniversityCollection($universities);
        } catch (Exception $ex) {
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUniversityRequest $request)
    {
        try {
            $attributes = $request->validated();

            $university = $this->universityService->create($attributes);

            return new UniversityResource($university);
        } catch (Exception $ex) {
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUniversityRequest $request, University $university)
    {
        try {
            $attributes = $request->validated();
            $university =   $this->universityService->update($university, $attributes);
            return new UniversityResource($university);
        } catch (Exception $ex) {
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(University $university)
    {
        try {
            $this->universityService->delete($university);
            return;
        } catch (Exception $ex) {
        }
    }
}
