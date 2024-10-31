<?php

namespace App\Models;

use App\Models\User;
use App\Models\CourseModule;
use App\Models\CategoryResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resource extends Model
{
    /** @use HasFactory<\Database\Factories\ResourceFactory> */
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function deleted_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by_id');
    }

    public function oldVsersion(): HasMany|null
    {
        return $this->hasMany(
            related: Resource::class,
            foreignKey: 'resource_id'
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            related: CategoryResource::class,
            foreignKey: 'category_id'
        );
    }

    public function courseModule(): BelongsTo
    {
        return $this->belongsTo(
            related: CourseModule::class,
            foreignKey: 'course_module_id'
        );
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(
            related: Teacher::class,
            foreignKey: 'teacher_id'
        );
    }
}
