<?php

namespace App\Http\Controllers;

use App\Models\Uploder;
use Illuminate\Http\Request;
use App\Services\UploderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UploderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private UploderService $uploderService;

    public function __construct(UploderService $uploderService)
    {
        $this->uploderService = $uploderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $uploders = $this->uploderService->getAllUploders();

        return view("admin.uploders.index", compact("uploders"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.uploders.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $attributes = $request->validated();

        $this->uploderService->createUploder($attributes);

        return to_route("admin.uploders.index")->with("success", "Moderateur creer !!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Uploder $uploder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Uploder $uploder)
    {
        return view("admin.uploders.edit", compact("uploder"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, Uploder $uploder)
    {
        $attributes = $request->validated();

        $this->uploderService->updateUploder($uploder, $attributes);

        return to_route("admin.uploders.index")->with("success", "Moderateur modifier !!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Uploder $uploder)
    {
        $this->uploderService->deleteUploder($uploder);

        return to_route("admin.uploders.index")->with("success", "Moderateur supprimer !!");
    }
}
