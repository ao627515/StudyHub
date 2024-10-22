<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    /** @use HasFactory<\Database\Factories\UniversityFactory> */
    use HasFactory;


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
