<?php

namespace App\Services;

use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use App\Models\AcademicProgramLevel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AcademicProgramLevelService
{
    /**
     * Create a new class AcademicProgramLevelService.
     */
    public function __construct()
    {
        //
    }

    /**
     * Retrieve a list of AcademicProgramLevels with optional pagination and relations.
     */
    public function index(int $paginate = 0, array|string $relations = [])
    {
        $relations = $this->decodeJson($relations, "Relations must be an array or a valid JSON string.");

        $query = AcademicProgramLevel::with($relations);
        return $paginate > 0 ? $query->paginate($paginate) : $query->get();
    }

    /**
     * Show a specific AcademicProgramLevel by ID or model instance with optional relations.
     */
    public function show(int|AcademicProgramLevel $academicProgramLevel, array|string $relations = [])
    {
        $relations = $this->decodeJson($relations, "Relations must be an array or a valid JSON string.");

        if (is_int($academicProgramLevel)) {
            $academicProgramLevel = AcademicProgramLevel::with($relations)->findOrFail($academicProgramLevel);
        } else {
            $academicProgramLevel->load($relations);
        }

        return $academicProgramLevel;
    }

    /**
     * Store a new AcademicProgramLevel.
     */
    public function store(array $attributes)
    {
        $attributes['created_by_id'] = Auth::id();

        return DB::transaction(function () use ($attributes) {
            return AcademicProgramLevel::create($attributes);
        });
    }

    /**
     * Update an existing AcademicProgramLevel by ID or model instance.
     */
    public function update(int|AcademicProgramLevel $academicProgramLevel, array $attributes)
    {
        $academicProgramLevel = $this->show($academicProgramLevel);

        return DB::transaction(function () use ($academicProgramLevel, $attributes) {
            $academicProgramLevel->update($attributes);
            return $academicProgramLevel;
        });
    }

    /**
     * Delete an existing AcademicProgramLevel by ID or model instance.
     */
    public function destroy(int|AcademicProgramLevel $academicProgramLevel)
    {
        $academicProgramLevel = $this->show($academicProgramLevel);

        return DB::transaction(function () use ($academicProgramLevel) {
            // $academicProgramLevel->update(['deleted_by_id' => Auth::id()]);
            $academicProgramLevel->delete();
            return $academicProgramLevel;
        });
    }

    /**
     * Decode JSON to array with error handling.
     */
    private function decodeJson($json, string $errorMessage = null)
    {
        if (is_array($json)) {
            return $json;
        }

        $decoded = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException($errorMessage ?? 'Invalid JSON format.');
        }

        return $decoded;
    }
}
