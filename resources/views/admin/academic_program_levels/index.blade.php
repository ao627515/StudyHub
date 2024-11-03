@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Academic Program Levels</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Academic Program Levels</li>
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
        <button class="btn btn-primary mb-3" onclick="openModal()">Add New Academic Program Level</button>

        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Academic Level</th>
                            <th>Academic Program</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($programLevels as $level)
                            <tr>
                                <td>{{ $level->id }}</td>
                                <td>{{ $level->academicLevel->name ?? 'N/A' }}</td>
                                <td>{{ $level->academicProgram->name ?? 'N/A' }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm"
                                        onclick="openModal({{ $level }})">Edit</button>
                                    <form action="{{ route('academic_program_levels.destroy', $level) }}" method="POST"
                                        style="display:inline-block;">
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

        <!-- Shared Modal for Create/Edit -->
        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formModalLabel">Add/Edit Academic Program Level</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="modalForm" method="POST">
                            @csrf
                            <input type="hidden" id="methodField" name="_method" value="POST">

                            <div class="mb-3">
                                <label for="academic_level_id">Academic Level</label>
                                <select name="academic_level_id" id="academic_level_id"
                                    class="form-select @error('academic_level_id') is-invalid @enderror" required>
                                    @foreach ($levels as $level)
                                        <option value="{{ $level->id }}"
                                            {{ old('academic_level_id') == $level->id ? 'selected' : '' }}>
                                            {{ $level->name }}</option>
                                    @endforeach
                                </select>
                                <!-- Affichage des erreurs pour le champ academic_level_id -->
                                @error('academic_level_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="academic_program_id">Academic Program</label>
                                <select name="academic_program_id" id="academic_program_id"
                                    class="form-select @error('academic_program_id') is-invalid @enderror" required>
                                    @foreach ($programs as $program)
                                        <option value="{{ $program->id }}"
                                            {{ old('academic_program_id') == $program->id ? 'selected' : '' }}>
                                            {{ $program->name }}</option>
                                    @endforeach
                                </select>
                                <!-- Affichage des erreurs pour le champ academic_program_id -->
                                @error('academic_program_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary" id="modalSubmitButton">Create</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        function openModal(level = null) {
            const formModal = new bootstrap.Modal(document.getElementById('formModal'));
            const form = document.getElementById('modalForm');
            const methodField = document.getElementById('methodField');
            const submitButton = document.getElementById('modalSubmitButton');
            const modalTitle = document.getElementById('formModalLabel');

            if (level) {
                // Edit Mode
                form.action = `{{ url('admin/academic_program_levels') }}/${level.id}`;
                methodField.value = 'PUT';
                submitButton.textContent = 'Update';
                modalTitle.textContent = 'Edit Academic Program Level';

                // Set selected options
                document.getElementById('academic_level_id').value = level.academic_level_id;
                document.getElementById('academic_program_id').value = level.academic_program_id;
            } else {
                // Create Mode
                form.action = `{{ route('admin.academic_program_levels.store') }}`;
                methodField.value = 'POST';
                submitButton.textContent = 'Create';
                modalTitle.textContent = 'Add New Academic Program Level';

                // Clear selections
                document.getElementById('academic_level_id').value = '';
                document.getElementById('academic_program_id').value = '';
            }
            formModal.show();
        }
    </script>
@endsection
