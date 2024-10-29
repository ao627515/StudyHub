@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Course Modules</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Course Modules</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->
    {{-- @dump($errors->all()) --}}

    @session('success')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Course Modules List</h5>

                        <!-- Bouton pour ouvrir le modal de création -->
                        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal"
                            data-bs-target="#createModal">
                            Add New Module
                        </button>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Creator</th>
                                    <th>Academic Program</th>
                                    <th>Academic Level</th>
                                    <th>University</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($modules as $module)
                                    <tr>
                                        <td>{{ $module->name }}</td>
                                        <td>{{ $module->createdBy->name ?? 'N/A' }}</td>
                                        <td>{{ $module->academicProgram->name ?? 'N/A' }}</td>
                                        <td>{{ $module->academicLevel->name ?? 'N/A' }}</td>
                                        <td>{{ $module->university->name ?? 'N/A' }}</td>
                                        <td>
                                            <!-- Bouton pour ouvrir le modal de modification -->
                                            <button type="button" class="btn btn-primary btn-sm edit-btn"
                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                data-id="{{ $module->id }}" data-name="{{ $module->name }}"
                                                data-academic-program-id="{{ $module->academic_program_level_id }}">
                                                Edit
                                            </button>

                                            <form action="{{ route('admin.course_modules.destroy', $module) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal pour la création d'un module -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.course_modules.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Add New Module</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Module Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="academic_program_level_id" class="form-label">Academic Program</label>
                            <select class="form-select" id="academic_program_level_id" name="academic_program_level_id">
                                <!-- Charger dynamiquement les options de programme académique -->
                                @foreach ($academicProgramLevels as $programLevel)
                                    <option value="{{ $programLevel->id }}">{{ $programLevel->academicProgram->name }} -
                                        {{ $programLevel->academicLevel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Module</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal pour la modification d'un module -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Module</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit-name" class="form-label">Module Name</label>
                            <input type="text" class="form-control" id="edit-name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-academic_program_level_id" class="form-label">Academic Program</label>
                            <select class="form-select" id="edit-academic_program_level_id"
                                name="academic_program_level_id">
                                @foreach ($academicProgramLevels as $programLevel)
                                    <option value="{{ $programLevel->id }}">{{ $programLevel->academicProgram->name }} -
                                        {{ $programLevel->academicLevel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Remplissage du modal d'édition avec les données du module sélectionné
        document.addEventListener('DOMContentLoaded', function() {
            const editBtns = document.querySelectorAll('.edit-btn');

            editBtns.forEach(button => {
                button.addEventListener('click', function() {
                    const moduleId = this.getAttribute('data-id');
                    const moduleName = this.getAttribute('data-name');
                    const programId = this.getAttribute('data-academic-program-id');

                    document.getElementById('edit-name').value = moduleName;
                    document.getElementById('edit-academic_program_level_id').value = programId;

                    // Mise à jour de l'action du formulaire d'édition avec l'ID du module
                    document.getElementById('editForm').action =
                        `{{ config('app.url') }}/admin/course_modules/${moduleId}`;
                });
            });
        });
    </script>
@endsection
