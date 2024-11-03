<?php

namespace App\Models;

use App\Models\User;
use App\Models\University;
use App\Models\AcademicLevel;
use App\Models\AcademicProgram;
use App\Models\AcademicProgramLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseModule extends Model
{
    /** @use HasFactory<\Database\Factories\CourseModuleFactory> */
    use HasFactory, SoftDeletes;


    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // mutators
    public function academicProgram(): Attribute
    {
        return Attribute::make(
            get: fn(): AcademicProgram|null => $this->academicProgramLevel->academicProgram
        );
    }

    public function university(): Attribute
    {
        return Attribute::make(
            get: fn(): University|null => $this->academicProgramLevel->academicProgram->university
        );
    }

    public function academicLevel(): Attribute
    {
        return Attribute::make(
            get: fn(): AcademicLevel|null => $this->academicProgramLevel->academicLevel
        );
    }


    // relashions
    public function academicProgramLevel(): BelongsTo
    {
        return $this->belongsTo(
            related: AcademicProgramLevelController::class,
            foreignKey: 'academic_program_level_id',
        );
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'created_by_id',
        );
    }

    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'deleted_by_id',
        );
    }
}
