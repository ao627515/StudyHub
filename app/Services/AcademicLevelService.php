<?php

namespace App\Services;

use App\Models\AcademicLevel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AcademicLevelService
{
    /**
     * Récupère la liste des niveaux académiques avec ou sans pagination et avec les relations spécifiées.
     */
    public function index(int $paginate = 0, array $relations = [])
    {
        $query = AcademicLevel::query()->with($relations);

        return $paginate ? $query->paginate($paginate) : $query->latest()->get();
    }

    /**
     * Crée un nouveau niveau académique avec les attributs spécifiés.
     */
    public function store(array $attributes): AcademicLevel
    {
        $attributes['created_by_id'] = Auth::id();

        return DB::transaction(fn() => AcademicLevel::create($attributes));
    }

    /**
     * Récupère un niveau académique par ID ou modèle, ou lance une exception s'il n'existe pas.
     */
    public function show(int|AcademicLevel $academicLevel): AcademicLevel
    {
        return $academicLevel instanceof AcademicLevel ? $academicLevel : AcademicLevel::findOrFail($academicLevel);
    }

    /**
     * Met à jour un niveau académique avec les attributs spécifiés.
     */
    public function update(int|AcademicLevel $academicLevel, array $attributes): bool
    {
        $academicLevel = $this->show($academicLevel);

        return DB::transaction(fn() => $academicLevel->update($attributes));
    }

    /**
     * Supprime un niveau académique spécifié.
     */
    public function destroy(int|AcademicLevel $academicLevel): bool
    {
        $academicLevel = $this->show($academicLevel);

        return DB::transaction(fn() => $academicLevel->delete());
    }
}