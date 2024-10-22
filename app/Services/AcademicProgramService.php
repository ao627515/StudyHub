<?php

namespace App\Services;

use App\Models\AcademicProgram;

class AcademicProgramService
{
    /**
     * Create a new class AcademicProgramService.
     */
    public function __construct()
    {
        //
    }

    public function getAll()
    {
        return AcademicProgram::latest()->get();
    }

    /**
     * Crée un nouvel moderateur.
     */
    public function create(array $attributes)
    {
        return AcademicProgram::create($attributes);
    }

    /**
     * Met à jour un moderateur existant.
     */
    public function update(AcademicProgram $academicProgram, array $attributes, array $options = [])
    {
        return $academicProgram->update($attributes);
    }

    /**
     * Supprime un moderateur.
     */
    public function delete(AcademicProgram $academicProgram)
    {
        return $academicProgram->delete();
    }
}