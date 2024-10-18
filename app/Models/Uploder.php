<?php

namespace App\Models;

use App\Models\User;
use App\Models\UserRole;
use App\Models\University;
use App\Models\AcademicLevel;
use App\Models\AcademicProgram;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Uploder extends User
{
    protected static function booted(): void
    {
        parent::booted();

        // Ajout d'un scope global pour filtrer les uploder
        static::addGlobalScope('role', function (Builder $builder) {
            $role = UserRole::when('name', 'uploder')->first();
            $builder->where('role_id', $role->id);
        });
    }

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class, 'university_id');
    }

    public function academic_level(): BelongsTo
    {
        return $this->belongsTo(AcademicLevel::class, 'academic_level_id');
    }

    public function academic_program(): BelongsTo
    {
        return $this->belongsTo(AcademicProgram::class, 'academic_program_id');
    }
}
