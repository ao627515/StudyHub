@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Créer une Ressource</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.resources.index') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Créer une Ressource</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Formulaire de Création de Ressource</h5>

                        <!-- Formulaire de création -->
                        <form action="{{ route('admin.resources.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image(optionnel)</label>
                                <input type="file" name="image"
                                    class="form-control @error('image') is-invalid @enderror" id="image">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="file" class="form-label">Resource</label>
                                <input type="file" name="file"
                                    class="form-control @error('file') is-invalid @enderror" id="file">
                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="course_module_id" class="form-label">Module de Cours</label>
                                <select name="course_module_id"
                                    class="form-select @error('course_module_id') is-invalid @enderror"
                                    id="course_module_id" required>
                                    <option value="">Sélectionner un module</option>
                                    <!-- Ajoutez ici les options de module de cours dynamiquement -->
                                    @foreach ($courseModules as $courseModule)
                                        <option value="{{ $courseModule->id }}">{{ $courseModule->name }}</option>
                                    @endforeach
                                </select>
                                @error('course_module_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <div class="mb-3">
                                <label for="resource_id" class="form-label">Ressource Parent</label>
                                <select name="resource_id" class="form-select @error('resource_id') is-invalid @enderror"
                                    id="resource_id">
                                    <option value="">Aucune</option>
                                    <!-- Ajoutez ici les options de ressources dynamiquement -->
                                    @foreach ([] as $parentResource)
                                        <option value="{{ $parentResource->id }}">{{ $parentResource->name }}</option>
                                    @endforeach
                                </select>
                                @error('resource_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}

                            <div class="mb-3">
                                <label for="category_id" class="form-label">Catégorie de Ressource</label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror"
                                    id="category_id" required>
                                    <option value="">Sélectionner une catégorie</option>
                                    <!-- Ajoutez ici les options de catégorie de ressource dynamiquement -->
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Créer</button>
                        </form>
                        <!-- Fin du formulaire -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
