<?php

namespace App\Services;

use App\Models\University;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UniversityService
{
    public function __construct()
    {
        // Service constructor
    }

    public function getAll()
    {
        return University::latest()->get();
    }

    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {
            if (isset($attributes['logo']) && $attributes['logo'] instanceof UploadedFile) {
                $attributes['logo'] = $attributes['logo']->store('universities', 'public');
            }

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
