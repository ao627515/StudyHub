<?php

namespace App\Services;

use App\Models\Uploader;
use App\Models\University;
use App\Models\AcademicLevel;
use App\Models\AcademicProgram;
use App\Models\AcademicProgramLevel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UploaderService
{
    /**
     * Récupère tous les uploaders, en incluant les relations nécessaires.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Uploader::with(['academicProgramLevel'])
            ->latest()
            ->get();
    }

    /**
     * Crée un nouvel uploader avec gestion des relations académiques.
     *
     * @param array $attributes
     * @return Uploader
     */
    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {
            $attributes['created_by_id'] = Auth::id();

            // dd($attributes);

            // Récupérer le programme académique
            $program = AcademicProgram::with('academicLevels')->find($attributes['academic_program_id']);

            // Vérifier si le programme existe et mettre à jour l'université si nécessaire
            if ($program && !$program->university_id) {
                $program->update(['university_id' => $attributes['university_id']]);
            }

            // Vérifier si le niveau académique est déjà associé au programme
            $programLevel = $program->academicLevels()->firstWhere('academic_level_id', $attributes['academic_level_id']);

            if (!$programLevel) {
                // Récupérer ou créer le niveau académique associé au programme
                $programLevel = AcademicProgramLevel::firstOrCreate(attributes: [
                    'academic_program_id' => $attributes['academic_program_id'],
                    'academic_level_id' => $attributes['academic_level_id'],
                ]);
            }


            // la methode firstOrCreate ne renvoie pas l'id donc je refait une requete
            if (!$programLevel->id) {
                $programLevel = AcademicProgramLevel::where('academic_program_id', $attributes['academic_program_id'])
                    ->where('academic_level_id', $attributes['academic_level_id'])
                    ->first();
            }

            // Associer l'ID du niveau de programme académique à l'uploader
            $attributes['academic_program_level_id'] = $programLevel->id;

            return Uploader::create($attributes);
        });
    }


    /**
     * Met à jour un uploader existant avec gestion des relations académiques.
     *
     * @param Uploader $uploader
     * @param array $attributes
     * @return bool
     */
    public function update(Uploader $uploader, array $attributes)
    {
        return DB::transaction(function () use ($uploader, $attributes) {
            // Mettre à jour les attributs de l'uploader
            $uploader->update($attributes);

            // Récupérer le programme académique
            $program = AcademicProgram::with('academicLevels')->find($attributes['academic_program_id']);

            // Vérifier si le programme existe et mettre à jour l'université si nécessaire
            if ($program && !$program->university_id) {
                $program->update(['university_id' => $attributes['university_id']]);
            }

            // Vérifier si le niveau académique est déjà associé au programme
            $programLevel = $program->academicLevels()->firstWhere('academic_level_id', $attributes['academic_level_id']);

            if (!$programLevel) {
                // Récupérer ou créer le niveau académique associé au programme
                $programLevel = AcademicProgramLevel::firstOrCreate([
                    'academic_program_id' => $attributes['academic_program_id'],
                    'academic_level_id' => $attributes['academic_level_id'],
                ]);
            }

            // la methode firstOrCreate ne renvoie pas l'id donc je refait une requete
            if (!$programLevel->id) {
                $programLevel = AcademicProgramLevel::where('academic_program_id', $attributes['academic_program_id'])
                    ->where('academic_level_id', $attributes['academic_level_id'])
                    ->first();
            }

            // Associer l'ID du niveau de programme académique à l'uploader
            $attributes['academic_program_level_id'] = $programLevel->id;

            // Mettre à jour l'uploader avec le nouvel ID de niveau de programme académique si nécessaire
            if ($uploader->academic_program_level_id !== $attributes['academic_program_level_id']) {
                $uploader->update(['academic_program_level_id' => $attributes['academic_program_level_id']]);
            }

            return true;
        });
    }


    /**
     * Supprime un uploader après avoir enregistré l'ID de l'utilisateur qui supprime.
     *
     * @param Uploader $uploader
     * @return bool|null
     */
    public function delete(Uploader $uploader)
    {
        $this->update($uploader, ['deleted_by_id' => Auth::id()]);
        return $uploader->delete();
    }

    /**
     * Récupère toutes les universités.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUniversities()
    {
        return University::all();
    }

    /**
     * Récupère tous les niveaux académiques.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAcademicLevels()
    {
        return AcademicLevel::all();
    }

    /**
     * Récupère tous les programmes académiques.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAcademicPrograms()
    {
        return AcademicProgram::all();
    }
}
