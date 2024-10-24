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

    public function getAllModerators()
    {
        return Moderator::all();
    }

    /**
     * Crée un nouvel moderateur.
     */
    public function createModerator(array $attributes)
    {
        $attibutes['created_by_id'] = Auth::id();
        return Moderator::create($attributes);
    }

    /**
     * Met à jour un moderateur existant.
     */
    public function updateModerator(Moderator $moderator, array $attributes, array $options = [])
    {
        return $moderator->update($attributes, $options);
    }

    /**
     * Supprime un moderateur.
     */
    public function deleteModerator(Moderator $moderator)
    {
        return $moderator->delete();
    }
}