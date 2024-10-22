@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Gestion des Universités</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Universités</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    @session('success')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    <section class="section">
        <div class="container">
            <!-- Bouton pour ouvrir le modal de création -->
            <div class="mb-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#universityModal">Ajouter une
                    Université</button>
            </div>

            <!-- Tableau d'affichage des universités -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Liste des Universités</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Logo</th>
                                <th>Abbréviation</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($universities as $university)
                                <tr>
                                    <td>{{ $university->id }}</td>
                                    <td>{{ $university->name }}</td>
                                    <td>
                                        @if ($university->getLogoUrl())
                                            <img src="{{ $university->getLogoUrl() }}" alt="Logo" width="50" />
                                        @else
                                            {{ 'Pas de logo' }}
                                        @endif
                                    </td>
                                    <td>{{ $university->abb }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#universityModal"
                                            onclick="editUniversity({{ $university }})">Modifier</button>
                                        <form action="{{ route('admin.universities.destroy', $university) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="confirm('Voulez-vous vraiment supprimer cette université ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="universityModal" tabindex="-1" aria-labelledby="universityModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="universityForm" method="POST" action="{{ route('admin.universities.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="university_id" name="university_id">
                        <div class="modal-header">
                            <h5 class="modal-title" id="universityModalLabel">Ajouter une Université</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Nom -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom de l'Université</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Logo -->
                            <div class="mb-3">
                                <label for="logo" class="form-label">Logo</label>
                                <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                    id="logo" name="logo" accept="image/*" onchange="previewLogo(event)">
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="mt-2" id="logoPreviewContainer" style="display: none;">
                                    <h6>Prévisualisation :</h6>
                                    <img id="logoPreview" src="" alt="Aperçu Logo" width="100" />
                                </div>
                            </div>

                            <!-- Abbréviation -->
                            <div class="mb-3">
                                <label for="abb" class="form-label">Abbréviation</label>
                                <input type="text" class="form-control @error('abb') is-invalid @enderror" id="abb"
                                    name="abb" value="{{ old('abb') }}" required>
                                @error('abb')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="currentLogoContainer" style="display: none;">
                                <h6>Logo Actuel :</h6>
                                <img id="currentLogo" src="" alt="Logo Actuel" width="100" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/universities-index.js') }}"></script>
@endsection
