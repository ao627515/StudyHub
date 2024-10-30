@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Gestion des Catégories de Ressources</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Catégories de Ressources</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <!-- Formulaire de création de catégorie -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Créer une Nouvelle Catégorie</h5>

                        <form action="{{ route('admin.category_resources.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom de la catégorie</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Créer</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Liste des catégories et formulaire de mise à jour -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liste des Catégories</h5>

                        @if ($categories->isEmpty())
                            <p>Aucune catégorie de ressource disponible.</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->description }}</td>
                                            <td>
                                                <!-- Formulaire de mise à jour inline -->
                                                <button class="btn btn-secondary btn-sm" data-bs-toggle="collapse"
                                                    data-bs-target="#editForm-{{ $category->id }}">Modifier</button>

                                                <form action="{{ route('admin.category_resources.destroy', $category) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')">Supprimer</button>
                                                </form>

                                                <!-- Formulaire de mise à jour -->
                                                <div class="collapse mt-2" id="editForm-{{ $category->id }}">
                                                    <form action="{{ route('admin.category_resources.update', $category) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-2">
                                                            <input type="text" class="form-control" name="name"
                                                                value="{{ $category->name }}" required>
                                                        </div>
                                                        <div class="mb-2">
                                                            <textarea class="form-control" name="description" rows="2">{{ $category->description }}</textarea>
                                                        </div>
                                                        <button type="submit"
                                                            class="btn btn-primary btn-sm">Enregistrer</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
