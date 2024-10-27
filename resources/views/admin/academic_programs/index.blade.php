@extends('admin.layouts.app')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('content')
    <div class="pagetitle">
        <h1>Programmes Académiques</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Programmes Académiques</li>
            </ol>
        </nav>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="section">
        <div class="container">
            <div class="mb-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#programModal">Ajouter un Programme
                    Académique</button>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Liste des Programmes Académiques</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Abbréviation</th>
                                <th>Universite</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($programs as $program)
                                <tr>
                                    <td>{{ $program->id }}</td>
                                    <td>{{ $program->name }}</td>
                                    <td>{{ $program->abb ?? 'N/A' }}</td>
                                    <td>{{ $program->university->name ?? 'N/A' }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#programModal"
                                            onclick="editProgram({{ $program }})">Modifier</button>
                                        <form action="{{ route('admin.academic_programs.destroy', $program) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Voulez-vous vraiment supprimer ce programme ?')">Supprimer</button>
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
        <div class="modal fade" id="programModal" tabindex="-1" aria-labelledby="programModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="programForm" method="POST" action="{{ route('admin.academic_programs.store') }}">
                        @csrf
                        <input type="hidden" id="program_id" name="program_id">
                        <div class="modal-header">
                            <h5 class="modal-title" id="programModalLabel">Ajouter un Programme Académique</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="abb" class="form-label">Abbréviation</label>
                                <input type="text" class="form-control @error('abb') is-invalid @enderror" id="abb"
                                    name="abb">
                                @error('abb')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="universities" class="form-label">Université</label>
                                <select class="form-select @error('university_id') is-invalid @enderror" id="universities"
                                    name="university_id">
                                    <option value="">Sélectionnez une Université</option>
                                    @foreach ($universities as $university)
                                        <option value="{{ $university->id }}" @selected(old('university_id') == $university->id)>
                                            {{ $university->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('university_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/admin/js/academic_programs-index.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Call the function to initialize Select2 with specific options
            initializeSelect2WithCreate({
                selectId: '#universities',
                apiUrl: 'http://127.0.0.1:8000/api/universities', // API endpoint
                placeholder: 'Search for a university...',
                noResultsMessage: 'No results found' // Custom no results message
            });
        });
    </script>
@endsection
