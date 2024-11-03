<?php

namespace App\Models;

use App\Models\University;
use App\Models\AcademicProgramLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AcademicProgram extends Model
{
    /** @use HasFactory<\Database\Factories\AcademicProgramFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function university(): BelongsTo
    {
        return $this->belongsTo(related: University::class, foreignKey: 'university_id');
    }

    public function academicProgramLevels(): HasMany
    {
        return $this->hasMany(related: AcademicProgramLevel::class, foreignKey: 'academic_program_id');
    }

    public function academicLevels(): BelongsToMany
    {
        return $this->belongsToMany(related: AcademicLevel::class, table: 'academic_program_levels', foreignPivotKey: 'academic_program_id', relatedPivotKey: 'academic_level_id')
            ->using(class: AcademicProgramLevel::class)
            ->withTimestamps();
    }
}
