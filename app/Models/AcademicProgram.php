<?php

namespace App\Models;

use App\Models\University;
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
}
