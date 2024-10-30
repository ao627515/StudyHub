<?php

namespace App\Services;

use App\Models\CategoryResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryResourceService
{
    /**
     * Récupère la liste des catégories de ressources avec ou sans pagination et avec les relations spécifiées.
     */
    public function index(int $paginate = 0, array $relations = [])
    {
        $query = CategoryResource::query()->with($relations);

        return $paginate ? $query->paginate($paginate) : $query->latest()->get();
    }

    /**
     * Crée une nouvelle catégorie de ressource avec les attributs spécifiés.
     */
    public function store(array $attributes): CategoryResource
    {
        $attributes['created_by_id'] = Auth::id();

        return DB::transaction(fn() => CategoryResource::create($attributes));
    }

    /**
     * Récupère une catégorie de ressource par ID ou modèle, ou lance une exception si elle n'existe pas.
     */
    public function show(int|CategoryResource $categoryResource): CategoryResource
    {
        return $categoryResource instanceof CategoryResource ? $categoryResource : CategoryResource::findOrFail($categoryResource);
    }

    /**
     * Met à jour une catégorie de ressource avec les attributs spécifiés.
     */
    public function update(int|CategoryResource $categoryResource, array $attributes): bool
    {
        $categoryResource = $this->show($categoryResource);

        return DB::transaction(fn() => $categoryResource->update($attributes));
    }

    /**
     * Supprime une catégorie de ressource spécifiée.
     */
    public function destroy(int|CategoryResource $categoryResource): bool
    {
        $categoryResource = $this->show($categoryResource);

        $this->update($categoryResource, ['deleted_by_id' => Auth::id()]);

        return DB::transaction(fn() => $categoryResource->delete());
    }
}