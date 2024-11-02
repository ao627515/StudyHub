@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Modifier une Ressource</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.resources.index') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Modifier une Ressource</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Formulaire de Modification de Ressource</h5>

                        <!-- Formulaire de modification -->
                        <form action="{{ route('admin.resources.update', $resource) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    value="{{ old('name', $resource->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description">{{ old('description', $resource->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image (optionnel)</label>
                                <input type="file" name="image"
                                    class="form-control @error('image') is-invalid @enderror" id="image">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @if ($resource->image_url)
                                    <div class="mt-2">
                                        <strong>Image actuelle :</strong>
                                        <img src="{{ asset($resource->image_url) }}" alt="Image actuelle"
                                            class="img-fluid mt-2" style="max-width: 200px;">
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="file" class="form-label">Ressource</label>
                                <input type="file" name="file"
                                    class="form-control @error('file') is-invalid @enderror" id="file">
                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @if ($resource->file_url)
                                    <div class="mt-2">
                                        <strong>Fichier actuel :</strong>
                                        <a href="{{ $resource->getFileUrl() }}" target="_blank">Voir le fichier
                                            actuel</a>
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="course_module_id" class="form-label">Module de Cours</label>
                                <select name="course_module_id"
                                    class="form-select @error('course_module_id') is-invalid @enderror"
                                    id="course_module_id" required>
                                    <option value="">Sélectionner un module</option>
                                    @foreach ($courseModules as $courseModule)
                                        <option value="{{ $courseModule->id }}" @selected(old('course_module_id', $resource->course_module_id) === $courseModule->id)>
                                            {{ $courseModule->name }}</option>
                                    @endforeach
                                </select>
                                @error('course_module_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="category_id" class="form-label">Catégorie de Ressource</label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror"
                                    id="category_id" required>
                                    <option value="">Sélectionner une catégorie</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(old('category_id', $resource->category_id) === $category->id)>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </form>
                        <!-- Fin du formulaire -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
