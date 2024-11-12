<?php

namespace App\Models;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use InvalidArgumentException;

class Administrator extends User
{

    protected static function booted(): void
    {
        parent::booted();

        $roles = UserRole::whereIn('name', ['administrator', 'super-administrator'])->pluck('id');

        if ($roles->isNotEmpty()) {
            static::addGlobalScope('role', function (Builder $builder) use ($roles) {
                $builder->whereIn('role_id', $roles);
            });
        } else {
            throw new InvalidArgumentException(static::class . ' is missing role');
        }
    }


    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($administrator) {
            $role = UserRole::where('name', 'administrator')->first();

            if ($role) {
                $administrator->role_id = $role->id;
            } else {
                throw new InvalidArgumentException(Administrator::class . ' is missing role');
            }
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
