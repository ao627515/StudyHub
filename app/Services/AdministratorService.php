<?php

namespace App\Services;

use App\Models\Administrator;
use Illuminate\Support\Facades\Auth;

class AdministratorService
{
    /**
     * Récupère tous les administrateurs.
     */
    public function index()
    {
        return Administrator::all();
    }

    /**
     * Crée un nouvel administrateur.
     */
    public function store(array $attributes)
    {
        $attibutes['created_by_id'] = Auth::id();
        return Administrator::create($attributes);
    }

    /**
     * Met à jour un administrateur existant.
     */
    public function update(Administrator $administrator, array $attributes, array $options = [])
    {
        return $administrator->update($attributes);
    }

    /**
     * Supprime un administrateur.
     */
    public function destroy(Administrator $administrator)
    {
        $this->update($administrator, ['deleted_by_id' => Auth::id()]);

        $administrator->delete();
    }
}
