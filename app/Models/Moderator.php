<?php

namespace App\Models;

use App\Models\UserRole;
use InvalidArgumentException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Moderator extends User
{
    protected static function booted(): void
    {
        parent::booted();

        $role = UserRole::where('name', 'moderator')->first();

        if ($role) {
            // Ajout d'un scope global pour filtrer les moderateurs
            static::addGlobalScope('role', function (Builder $builder) use ($role) {
                $builder->where('role_id', $role->id);
            });
        } else {
            throw new InvalidArgumentException(Moderator::class . ' is missing role');
        }
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($moderator) {
            $role = UserRole::where('name', 'moderator')->first();

            if ($role) {
                $moderator->role_id = $role->id;
            } else {
                throw new InvalidArgumentException(Moderator::class . ' is missing role');
            }
        });
    }

    public function resources_deleted() {}
}
