<?php

namespace App\Models;

use App\Models\User;
use App\Models\Teacher;
use App\Models\CourseModule;
use InvalidArgumentException;
use App\Models\CategoryResource;
use App\Models\AcademicProgramLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resource extends Model
{
    /** @use HasFactory<\Database\Factories\ResourceFactory> */
    use HasFactory;

    public const BYTE = 'B';
    public const KILOBYTE = 'KB';
    public const MEGABYTE = 'MB';
    public const GIGABYTE = 'GB';
    public const TERABYTE = 'TB';

    const UNITS = [
        self::BYTE,
        self::KILOBYTE,
        self::MEGABYTE,
        self::GIGABYTE,
        self::TERABYTE,
    ];

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


    // att
    public function academicProgram(): Attribute
    {
        return Attribute::make(
            get: fn(): AcademicProgram|null => $this->courseModule?->academicProgramLevel?->academicProgram
        );
    }

    public function university(): Attribute
    {
        return Attribute::make(
            get: fn(): University|null => $this->courseModule?->academicProgramLevel?->academicProgram?->university
        );
    }

    public function academicLevel(): Attribute
    {
        return Attribute::make(
            get: fn(): AcademicLevel|null => $this->courseModule?->academicProgramLevel?->academicLevel
        );
    }

    // methode

    public function getFileUrl()
    {
        return asset('storage/' . $this->file_url);
    }

    public function getImageUrl()
    {
        return $this->image_url ? asset('storage/' . $this->image_url) :  asset('assets/public/img/book.png');
    }

    public function formatFileSize()
    {
        return $this->getFileSize(unit: null, format: true);
    }

    // Méthode pour convertir la taille avec ou sans unité spécifique
    public function getFileSize($unit = null, $format = false)
    {
        $size = $this->file_size;

        if ($unit === null) {
            // Si format est activé, on choisit automatiquement l'unité appropriée
            if ($format) {
                foreach (self::UNITS as $index => $currentUnit) {
                    if ($size < 1024 || $index == count(self::UNITS) - 1) {
                        $unit = $currentUnit;
                        break;
                    }
                    $size /= 1024;
                }
            } else {
                // Si format est désactivé, on retourne la taille en octets
                $unit = self::BYTE;
            }
        } else {
            // Conversion manuelle selon l'unité spécifiée
            $index = array_search(strtoupper($unit), self::UNITS);
            if ($index === false) {
                throw new InvalidArgumentException("Unité non valide : {$unit}. Utilisez une des constantes de classe.");
            }
            $size /= (1024 ** $index);
        }

        // Arrondit et ajoute l'unité si le formatage est activé
        return $format ? round($size, 2) . " $unit" : $size;
    }
}
