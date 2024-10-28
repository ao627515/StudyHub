<?php

namespace App\Services;

use App\Models\University;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use InvalidArgumentException;


class UniversityService
{
    public function __construct()
    {
        // Service constructor
    }

    public function getAll($paginate = 0, array|string $relations = [])
    {
        $query = University::query();

        if (is_string($relations)) {
            $relations = json_decode($relations);
            // Vérification que la conversion a réussi
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new InvalidArgumentException('request relations parameter is invalid json string');
            }
        }

        if (!empty($relations)) {
            $query->with(relations: $relations);
        }

        // dd($relations);



        if ($paginate) {
            return $query->paginate($paginate);
        }

        return $query->latest()->get();
    }

    public function getUniversity(int $universityId, array $relations = [])
    {
        $university = University::findOrFail($universityId);

        $university->loadMissing($relations);


        return $university;
    }

    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {
            if (isset($attributes['logo']) && $attributes['logo'] instanceof UploadedFile) {
                $attributes['logo'] = $attributes['logo']->store('universities', 'public');
            }
            $attributes['created_by_id'] = Auth::id();

            return University::create($attributes);
        });
    }

    public function update(University $university, array $attributes, array $options = [])
    {
        return DB::transaction(function () use ($attributes, $university, $options) {
            if (isset($attributes['logo']) && $attributes['logo'] instanceof UploadedFile) {
                $this->deleteUniversityLogo($university->logo);
                $attributes['logo'] = $attributes['logo']->store('universities', 'public');
            }

            return $university->update($attributes, $options);
        });
    }

    public function delete(University $university)
    {
        if ($university->logo) {
            $this->deleteUniversityLogo($university->logo);
        }

        $this->update($university, ['deleted_by_id' => Auth::id()]);

        return $university->delete();
    }

    private function deleteUniversityLogo(?string $path)
    {
        if ($path) {
            return Storage::disk('public')->delete($path);
        }



        return false;
    }
}