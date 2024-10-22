<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUniversityRequest;
use App\Http\Requests\UpdateUniversityRequest;
use App\Models\University;
use App\Services\UniversityService;
use Database\Seeders\UniversitySeeder;
use Illuminate\Http\Request;

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
        $universities = $this->universityService->getALl();

        return view("admin.universities.index", compact("universities"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.universities.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUniversityRequest $request)
    {
        $attributes = $request->validated();

        $this->universityService->create($attributes);

        return to_route("admin.universities.index")->with("success", "Universite cree !!");
    }

    /**
     * Display the specified resource.
     */
    public function show(University $university)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(University $university)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUniversityRequest $request, University $university)
    {
        $attributes = $request->validated();

        $this->universityService->update($university, $attributes);

        return to_route("admin.universities.index")->with("success", "Universite modifier !!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(University $university)
    {


        $this->universityService->delete($university);

        return to_route("admin.universities.index")->with("success", "Universite supprimer !!");
    }
}
