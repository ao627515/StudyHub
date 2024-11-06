<?php

namespace App\Services;

use App\Models\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ResourceService
{
    /**
     * Récupère la liste des ressources avec ou sans pagination et avec les relations spécifiées.
     */
    public function index(int $paginate = 0, array $relations = [])
    {
        $query = Resource::query()->with($relations);

        $query = Auth::user()->isUploader() ? $query->where('created_by_id', Auth::id()) : $query;

        return $paginate ? $query->paginate($paginate) : $query->latest()->get();
    }

    private  function getResourcesByUserAuth(Builder $builder) {}

    /**
     * Crée une nouvelle ressource avec les attributs spécifiés.
     */
    public function store(array $attributes): Resource
    {
        // Ajout de l'ID de l'utilisateur connecté
        $attributes['created_by_id'] = Auth::id();

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

    private function deleteFiles(array $paths = [])
    {

        foreach ($paths as $path) {

            Storage::disk('public')->delete($paths);
        }
    }
}
