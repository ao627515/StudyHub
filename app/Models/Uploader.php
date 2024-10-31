<?php

namespace App\Models;

use App\Models\User;
use App\Models\UserRole;
use App\Models\University;
use App\Models\AcademicLevel;
use InvalidArgumentException;
use App\Models\AcademicProgram;
use App\Models\AcademicProgramLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function university(): Attribute
    {
        return Attribute::make(
            get: fn(): University|null => $this->academicProgramLevel?->academicProgram?->university
        );
    }

    public function academicLevel(): Attribute
    {
        return Attribute::make(
            get: fn(): AcademicLevel|null => $this->academicProgramLevel?->academicLevel
        );
    }

    public function academicProgram(): Attribute
    {
        return Attribute::make(
            get: fn(): AcademicProgram|null => $this->academicProgramLevel?->academicProgram
        );
    }

    public function academicProgramLevel(): BelongsTo
    {
        return $this->belongsTo(
            related: AcademicProgramLevel::class,
            foreignKey: 'academic_program_level_id'

        );
    }
}
