<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use PHPUnit\Framework\MockObject\Stub\ReturnStub;

class AcademicProgramLevel extends Pivot
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    protected $table = 'academic_program_levels';

    public function academicProgram()
    {
        return $this->belongsTo(AcademicProgram::class, 'academic_program_id');
    }

    public function academicLevel()
    {
        return $this->belongsTo(AcademicLevel::class, 'academic_level_id');
    }
}