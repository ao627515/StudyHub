<?php

namespace App\Services;

use App\Models\AcademicProgram;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AcademicProgramService
{
    public function __construct()
    {
        //
    }

    public function getAll()
    {
        return AcademicProgram::latest()->get();
    }

    /**
     * Crée un nouvel programme académique dans une transaction.
     */
    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {
            $attributes['created_by_id'] = Auth::id();
            return AcademicProgram::create($attributes);
        });
    }

    /**
     * Met à jour un programme académique existant dans une transaction.
     */
    public function update(AcademicProgram $academicProgram, array $attributes, array $options = [])
    {
        return DB::transaction(function () use ($academicProgram, $attributes) {
            $academicProgram->update($attributes);
            return $academicProgram->refresh();
        });
    }

    /**
     * Supprime un programme académique dans une transaction.
     */
    public function delete(AcademicProgram $academicProgram)
    {
        $this->update($academicProgram, ['deleted_by_id' => Auth::id()]);

        return DB::transaction(function () use ($academicProgram) {
            $academicProgram->delete();
            return true;
        });
    }
}