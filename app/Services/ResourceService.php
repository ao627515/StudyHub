<?php

namespace App\Services;

use App\Models\Resource;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ResourceService
{
    /**
     * Récupère la liste des ressources avec ou sans pagination et avec les relations spécifiées.
     */
    public function index(array $params)
    {
        $query = Resource::query()->with($params['relations']);

        $filters = [
            'university' => fn($query, $value) => $query->whereHas(
                'courseModule.academicProgramLevel.academicProgram',
                fn($query) => $query->where('university_id', $value)
            ),
            'program' => fn($query, $value) => $query->whereHas(
                'courseModule.academicProgramLevel',
                fn($query) => $query->where('academic_program_id', $value)
            ),
            'level' => fn($query, $value) => $query->whereHas(
                'courseModule.academicProgramLevel',
                fn($query) => $query->where('academic_level_id', $value)
            ),
            'module' => fn($query, $value) => $query->where('course_module_id', $value),
            'category' => fn($query, $value) => $query->where('category_id', $value),
            'name' => fn($query, $value) => $query->where('name', 'LIKE', "%$value%"),
            'schoolYear' => fn($query, $value) => $query->where('schoolYear', 'LIKE', "%$value%"),
        ];

        foreach ($filters as $param => $callback) {
            $query->when($params[$param] ?? null, fn($query) => $callback($query, $params[$param]));
        }

        if (Auth::user()?->isUploader() && Route::is('*admin*')) {
            $query->where('created_by_id', Auth::id());
        }

        if ($this->validateParam($params, 'paginate', fn($value) => is_numeric($value) && $value > 0)) {
            return $query->paginate($params['paginate']);
        }

        if ($this->validateParam($params, 'limit', fn($value) => is_numeric($value) && $value > 0)) {
            $query->limit($params['limit']);
        }

        return $query->latest()->get();
    }

    private function validateParam(array $params, string $key, callable $condition): bool
    {
        return isset($params[$key]) && $condition($params[$key]);
    }


    /**
     * Crée une nouvelle ressource avec les attributs spécifiés.
     */
    public function store(array $attributes): Resource
    {
        // Ajout de l'ID de l'utilisateur connecté
        $attributes['created_by_id'] = Auth::id();

        $attributes['school_year'] = $attributes['schoolYear'];

        // Gestion du fichier image
        if (isset($attributes['image'])) {
            $attributes['image_url'] = $attributes['image']->store('resources/images', 'public');
        }

        $attributes['file_url'] = $attributes['file']->store('resources/file', 'public');
        $attributes['file_type'] = $attributes['file']->getClientOriginalExtension();
        $attributes['file_size'] = $attributes['file']->getSize();

        if (isset($attributes['resource_id'])) {
            $oldVersion = Resource::where('id', $attributes['resource_id'])->first()->version;

            $attributes['version'] =  $oldVersion == null ? 1 : ++$oldVersion;
        }

        return DB::transaction(fn() => Resource::create($attributes));
    }


    /**
     * Récupère une ressource par ID ou modèle, ou lance une exception si elle n'existe pas.
     */
    public function show(int|Resource $resource): Resource
    {
        return $resource instanceof Resource ? $resource : Resource::findOrFail($resource);
    }

    /**
     * Met à jour une ressource avec les attributs spécifiés.
     */
    public function update(int|Resource $resource, array $attributes): bool
    {
        $resource = $this->show($resource);

        // Gestion du fichier image
        if (isset($attributes['image'])) {

            Storage::disk('public')->delete($resource->image_url);
            $attributes['image_url'] = $attributes['image']->store('resources/files', 'public');
        }

        if (isset($attributes['resource'])) {

            Storage::disk('public')->delete($resource->file_url);

            $attributes['file_url'] = $attributes['file']->store('resources/files', 'public');
            $attributes['file_type'] = $attributes['file']->getClientOriginalExtension();
            $attributes['file_size'] = $attributes['file']->getSize();
            $attributes['download_url'] = asset('storage/' . $attributes['file_url']);
        }

        if (isset($attributes['resource_id'])) {
            $oldVersion = Resource::where('id', $attributes['resource_id'])->first()->version;

            $attributes['version'] =  $oldVersion == null ? 1 : ++$oldVersion;
        }

        return DB::transaction(fn() => $resource->update($attributes));
    }

    /**
     * Supprime une ressource spécifiée.
     */
    public function destroy(int|Resource $resource): bool
    {
        $resource = $this->show($resource);

        $this->deleteFiles([$resource->image_url, $resource->file_url]);

        // Optionnel : Marquer la ressource comme supprimée
        $this->update($resource, ['deleted_by_id' => Auth::id()]);

        return DB::transaction(fn() => $resource->delete());
    }

    public function downloadFile(int|Resource $resource)
    {

        $resource = $this->show($resource);

        // Chemin du fichier dans le dossier de stockage
        $filePath = storage_path("app/public/{$resource->file_url}");

        // Vérifie si le fichier existe
        if (!file_exists($filePath)) {
            throw new Exception("File url not exist");
        }

        $this->update($resource, ['download_count' => ++$resource->download_count]);

        return $filePath;
    }

    public function view(int|Resource $resource)
    {
        $resource = $this->show($resource);

        // Chemin du fichier dans le dossier de stockage
        $filePath = storage_path("app/public/{$resource->file_url}");

        // Vérifie si le fichier existe
        if (!file_exists($filePath)) {
            throw new Exception("File url not exist");
        }

        return $resource;
    }

    private function deleteFiles(array $paths = [])
    {

        foreach ($paths as $path) {

            Storage::disk('public')->delete($paths);
        }
    }
}
