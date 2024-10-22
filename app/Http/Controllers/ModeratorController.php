<?php

namespace App\Http\Controllers;

use App\Models\Moderator;
use Illuminate\Http\Request;
use App\Services\ModeratorService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class ModeratorController extends Controller
{
    private ModeratorService $moderatorService;

    public function __construct(ModeratorService $moderatorService)
    {
        $this->moderatorService = $moderatorService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $moderators = $this->moderatorService->getAllModerators();

        return view("admin.moderators.index", compact("moderators"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.moderators.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $attributes = $request->validated();

        $this->moderatorService->createModerator($attributes);

        return to_route("admin.moderators.index")->with("success", "Moderateur creer !!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Moderator $moderator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Moderator $moderator)
    {
        return view("admin.moderators.edit", compact("moderator"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, Moderator $moderator)
    {
        $attributes = $request->validated();

        $this->moderatorService->updateModerator($moderator, $attributes);

        return to_route("admin.moderators.index")->with("success", "Moderateur modifier !!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Moderator $moderator)
    {
        $this->moderatorService->deleteModerator($moderator);

        return to_route("admin.moderators.index")->with("success", "Moderateur supprimer !!");
    }
}
