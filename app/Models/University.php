<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class University extends Model
{
    /** @use HasFactory<\Database\Factories\UniversityFactory> */
    use HasFactory, SoftDeletes;


    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function getLogoUrl()
    {
        return $this->logo === null ? null : asset('storage/' . $this->logo);
    }
}
