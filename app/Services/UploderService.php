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

    public function getAllUploders()
    {
        return Uploder::all();
    }

    /**
     * Crée un nouvel moderateur.
     */
    public function createUploder(array $attributes)
    {
        return Uploder::create($attributes);
    }

    /**
     * Met à jour un moderateur existant.
     */
    public function updateUploder(Uploder $uploder, array $attributes, array $options = [])
    {
        return $uploder->update($attributes);
    }

    /**
     * Supprime un moderateur.
     */
    public function deleteUploder(Uploder $uploder)
    {
        return $uploder->delete();
    }
}