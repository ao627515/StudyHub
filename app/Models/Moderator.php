<?php

namespace App\Models;

use App\Models\UserRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Moderator extends User
{
    protected static function booted(): void
    {
        parent::booted();

        // Ajout d'un scope global pour filtrer les administrateurs
        static::addGlobalScope('role', function (Builder $builder) {
            $role = UserRole::when('name', 'moderator')->first();
            $builder->where('role_id', $role->id);
        });
    }
}
