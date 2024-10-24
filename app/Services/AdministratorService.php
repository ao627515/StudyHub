<?php

namespace App\Services;

use App\Models\Administrator;
use Illuminate\Support\Facades\Auth;

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
        $attibutes['created_by_id'] = Auth::id();
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
        $this->updateAdministrator($administrator, ['deleted_by_id' => Auth::id()]);

        $administrator->delete();
    }
}
