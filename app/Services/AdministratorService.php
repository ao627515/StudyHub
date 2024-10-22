<?php

namespace App\Services;

use App\Models\Administrator;

class AdministratorService
{
    /**
     * Récupère tous les administrateurs.
     */
    public function getAllAdministrators()
    {
        return Administrator::all();
    }

    /**
     * Crée un nouvel administrateur.
     */
    public function createAdministrator(array $attributes)
    {
        return Administrator::create($attributes);
    }

    /**
     * Met à jour un administrateur existant.
     */
    public function updateAdministrator(Administrator $administrator, array $attributes, array $options = [])
    {
        return $administrator->update($attributes);
    }

    /**
     * Supprime un administrateur.
     */
    public function deleteAdministrator(Administrator $administrator)
    {
        $administrator->delete();
    }
}
