<?php

namespace App\Services;

use App\Models\Uploader;
use App\Models\University;
use App\Models\AcademicLevel;
use App\Models\AcademicProgram;
use Illuminate\Support\Facades\Auth;

class UploaderService
{
    public function __construct()
    {
        //
    }

    public function getAll()
    {
        return Uploader::latest()->with(['university', 'academicLevel', 'academicProgram'])->get();
    }

    /**
     * Crée un nouvel uploader.
     */
    public function create(array $attributes)
    {
        $attributes['created_by_id'] = Auth::id();
        return Uploader::create($attributes);
    }

    /**
     * Met à jour un uploader existant.
     */
    public function update(Uploader $uploader, array $attributes)
    {
        return $uploader->update($attributes);
    }

    /**
     * Supprime un uploader.
     */
    public function delete(Uploader $uploader)
    {
        $this->update($uploader, ['deleted_by_id' => Auth::id()]);

        return $uploader->delete();
    }

    /**
     * Récupère toutes les universités.
     */
    public function getUniversities()
    {
        return University::all();
    }

    /**
     * Récupère tous les niveaux académiques.
     */
    public function getAcademicLevels()
    {
        return AcademicLevel::all();
    }

    /**
     * Récupère tous les programmes académiques.
     */
    public function getAcademicPrograms()
    {
        return AcademicProgram::all();
    }
}
