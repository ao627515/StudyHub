<?php

namespace App\Services;

use App\Models\Moderator;

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
        return Moderator::create($attributes);
    }

    /**
     * Met à jour un moderateur existant.
     */
    public function updateModerator(Moderator $administrator, array $attributes, array $options = [])
    {
        return $administrator->update($attributes);
    }

    /**
     * Supprime un moderateur.
     */
    public function deleteModerator(Moderator $administrator)
    {
        $administrator->delete();
    }
}
