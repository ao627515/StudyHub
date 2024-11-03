<?php

namespace App\Models;

use App\Models\AcademicProgramLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AcademicLevel extends Model
{
    /** @use HasFactory<\Database\Factories\AcademicLevelFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function academicProgramLevels(): HasMany
    {
        return $this->hasMany(AcademicProgramLevel::class, 'academic_level_id');
    }

    public function academicPrograms(): BelongsToMany
    {
        return $this->belongsToMany(related: AcademicProgram::class, table: 'academic_program_levels', foreignPivotKey: 'academic_level_id', relatedPivotKey: 'academic_program_id')
            ->using(class: AcademicProgramLevel::class)
            ->withTimestamps();
    }
}
