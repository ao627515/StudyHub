<?php

namespace App\Services;

use App\Models\CourseModule;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;

class CourseModuleService
{
    /**
     * Retrieve paginated or non-paginated list of course modules with optional relations.
     *
     * @param int $paginate
     * @param array|string $relations
     * @return mixed
     */
    public function index(int $paginate = 0, array|string $relations = [])
    {
        $query = CourseModule::query();

        $relations = $this->parseRelations($relations);

        if (!empty($relations)) {
            $query->with($relations);
        }

        /**
         * @var User $user
         */
        $user = Auth::user();
        if ($user->isUploader()) {
            $query->where('created_by_id', $user->id);
        }

        return $paginate ? $query->paginate($paginate) : $query->latest()->get();
    }

    /**
     * Store a new course module with creator ID.
     *
     * @param array $attributes
     * @return CourseModule
     */
    public function store(array $attributes): CourseModule
    {
        $attributes['created_by_id'] = Auth::id();

        return DB::transaction(fn() => CourseModule::create($attributes));
    }

    /**
     * Show a specific course module with optional relations.
     *
     * @param int|CourseModule $courseModule
     * @param array|string $relations
     * @return CourseModule|null
     */
    public function show(int|CourseModule $courseModule, array|string $relations = []): ?CourseModule
    {
        $courseModule = $this->resolveCourseModule($courseModule);
        $relations = $this->parseRelations($relations);

        return $courseModule?->loadMissing($relations);
    }

    /**
     * Update a specific course module.
     *
     * @param int|CourseModule $courseModule
     * @param array $attributes
     * @return bool
     */
    public function update(int|CourseModule $courseModule, array $attributes): bool
    {
        $courseModule = $this->resolveCourseModule($courseModule);

        return DB::transaction(fn() => $courseModule->update($attributes));
    }

    /**
     * Delete a specific course module.
     *
     * @param int|CourseModule $courseModule
     * @return bool|null
     */
    public function delete(int|CourseModule $courseModule): ?bool
    {
        $courseModule = $this->resolveCourseModule($courseModule);
        $attributes['deleted_by_id']
            = Auth::id();
        $this->update($courseModule, $attributes);
        return $courseModule?->delete();
    }

    /**
     * Parse the relations parameter into an array if it’s a JSON string.
     *
     * @param array|string $relations
     * @return array
     */
    private function parseRelations(array|string $relations): array
    {
        if (is_string($relations)) {
            $relations = json_decode($relations, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new InvalidArgumentException('Relations parameter is invalid JSON.');
            }
        }

        return (array) $relations;
    }

    /**
     * Resolve the course module by ID or return the model instance.
     *
     * @param int|CourseModule $courseModule
     * @return CourseModule|null
     */
    private function resolveCourseModule(int|CourseModule $courseModule): ?CourseModule
    {
        return $courseModule instanceof CourseModule ? $courseModule : CourseModule::find($courseModule);
    }
}
