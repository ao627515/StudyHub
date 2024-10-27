<?php

namespace App\Models;

use App\Models\University;
use App\Models\AcademicProgramLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicProgram extends Model
{
    /** @use HasFactory<\Database\Factories\AcademicProgramFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function university()
    {
        return $this->belongsTo(University::class, 'university_id');
    }

    public function academicProgramLevels()
    {
        return $this->hasMany(AcademicProgramLevel::class, 'academic_program_id');
    }

    public function academicLevels()
    {
        return $this->belongsToMany(related: CourseModule::class, table: 'academic_program_levels', foreignPivotKey: 'academic_program_id', relatedPivotKey: 'academic_level_id')
            ->using(class: AcademicProgramLevel::class)
            ->withTimestamps();
    }
}
