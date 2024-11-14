<?php

namespace App\Services;

use App\Models\Moderator;
use Illuminate\Support\Facades\Auth;

class ModeratorService
{
    /**
     * Create a new class ModeratorService.
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        return Moderator::all();
    }

    /**
     * Crée un nouvel moderateur.
     */
    public function store(array $attributes)
    {
        $attibutes['created_by_id'] = Auth::id();
        return Moderator::create($attributes);
    }

    /**
     * Met à jour un moderateur existant.
     */
    public function update(Moderator $moderator, array $attributes, array $options = [])
    {
        return $moderator->update($attributes, $options);
    }

    /**
     * Supprime un moderateur.
     */
    public function destroy(Moderator $moderator)
    {
        $this->update($moderator, ['deleted_by_id' => Auth::id()]);

        return $moderator->delete();
    }
}
