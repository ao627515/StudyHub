<?php

namespace App\Models;

use App\Models\User;
use App\Models\UserRole;
use App\Models\University;
use App\Models\AcademicLevel;
use InvalidArgumentException;
use App\Models\AcademicProgram;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Uploader extends User
{
    protected static function booted(): void
    {
        parent::booted();

        $role = UserRole::where('name', 'uploader')->first();

        if ($role) {
            // Ajout d'un scope global pour filtrer les uploaders
            static::addGlobalScope('role', function (Builder $builder) use ($role) {
                $builder->where('role_id', $role->id);
            });
        } else {
            throw new InvalidArgumentException(Uploader::class . ' is missing role');
        }
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($uploader) {
            $role = UserRole::where('name', 'uploader')->first();

            if ($role) {
                $uploader->role_id = $role->id;
            } else {
                throw new InvalidArgumentException(Uploader::class . ' is missing role');
            }
        });
    }

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class, 'university_id');
    }

    public function academicLevel(): BelongsTo
    {
        return $this->belongsTo(AcademicLevel::class, 'academic_level_id');
    }

    public function academicProgram(): BelongsTo
    {
        return $this->belongsTo(AcademicProgram::class, 'academic_program_id');
    }
}
