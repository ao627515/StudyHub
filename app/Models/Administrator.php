<?php

namespace App\Models;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Administrator extends User
{
    protected static function booted(): void
    {
        parent::booted();

        // Ajout d'un scope global pour filtrer les administrateurs
        static::addGlobalScope('role', function (Builder $builder) {
            $role = UserRole::when('name', 'administrator')->first();
            $builder->where('role_id', $role->id);
        });
    }

    public function has_deleted(): HasMany
    {
        return $this->hasMany(User::class, 'deleted_by_id');
    }

    public function has_created(): HasMany
    {
        return $this->hasMany(User::class, 'created_by_id');
    }
}
