<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicLevel extends Model
{
    /** @use HasFactory<\Database\Factories\AcademicLevelFactory> */
    use HasFactory, SoftDeletes;
}
