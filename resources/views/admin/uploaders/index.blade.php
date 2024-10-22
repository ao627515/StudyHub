@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Liste des Uploaders</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                <li class="breadcrumb-item">Gestion des Uploaders</li>
                <li class="breadcrumb-item active">Liste</li>
            </ol>
        </nav>
    </div>

    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liste des Uploaders</h5>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Bouton pour ajouter un nouvel uploader -->
                        <a href="{{ route('admin.uploaders.create') }}" class="btn btn-primary mb-3">Ajouter un Uploader</a>

                        <!-- Table pour afficher la liste des uploaders -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                    <th>Université</th>
                                    <th>Niveau académique</th>
                                    <th>Programme académique</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($uploaders as $uploader)
                                    <tr>
                                        <td>{{ $uploader->id }}</td>
                                        <td>{{ $uploader->lastname }}</td>
                                        <td>{{ $uploader->firstname }}</td>
                                        <td>{{ $uploader->phone }}</td>
                                        <td>{{ $uploader->email }}</td>
                                        <td>{{ $uploader->university->name ?? 'Non spécifié' }}</td>
                                        <td>{{ $uploader->academicLevel->name ?? 'Non spécifié' }}</td>
                                        <td>{{ $uploader->academicProgram->name ?? 'Non spécifié' }}</td>
                                        <td>
                                            <a href="{{ route('admin.uploaders.edit', $uploader->id) }}"
                                                class="btn btn-warning btn-sm">Modifier</a>

                                            <!-- Formulaire pour la suppression -->
                                            <form action="{{ route('admin.uploaders.destroy', $uploader->id) }}"
                                                method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet uploader ?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Aucun uploader trouvé.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
