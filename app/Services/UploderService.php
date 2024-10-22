<?php

namespace App\Services;

use App\Models\Uploder;

class UploderService
{
    /**
     * Create a new class UploderService.
     */
    public function __construct()
    {
        //
    }

    public function getAll()
    {
        return Uploder::latest()->get();
    }

    /**
     * Crée un nouvel moderateur.
     */
    public function create(array $attributes)
    {
        return Uploder::create($attributes);
    }

    /**
     * Met à jour un moderateur existant.
     */
    public function update(Uploder $uploder, array $attributes, array $options = [])
    {
        return $uploder->update($attributes);
    }

    /**
     * Supprime un moderateur.
     */
    public function delete(Uploder $uploder)
    {
        return $uploder->delete();
    }
}
