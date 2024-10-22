<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Administrator;
use App\Services\AdministratorService;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{

    private AdministratorService $adminService;

    public function __construct(AdministratorService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $administrators = $this->adminService->getAllAdministrators();

        return view("admin.administrators.index", compact("administrators"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.administrators.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $attributes = $request->validated();

        $this->adminService->createAdministrator($attributes);

        return to_route("admin.administrators.index")->with("success", "Administrateur creer !!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Administrator $administrator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administrator $administrator)
    {
        return view("admin.administrators.edit", compact("administrator"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, Administrator $administrator)
    {
        $attributes = $request->validated();

        $this->adminService->updateAdministrator($administrator, $attributes);

        return to_route("admin.administrators.index")->with("success", "Administrateur modifier !!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrator $administrator)
    {
        $this->adminService->deleteAdministrator($administrator);

        return to_route("admin.administrators.index")->with("success", "Administrateur supprimer !!");
    }
}