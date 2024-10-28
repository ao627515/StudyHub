@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Academic Levels</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Pages</li>
                <li class="breadcrumb-item active">Academic Levels</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <!-- Card for displaying academic levels list -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Academic Levels List</h5>

                        <!-- Button to trigger create modal -->
                        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Add New
                            Academic Level</button>

                        <!-- Table to list academic levels -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Abbreviation</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($academicLevels as $level)
                                    <tr>
                                        <td>{{ $level->name }}</td>
                                        <td>{{ $level->abb }}</td>
                                        <td>{{ $level->description }}</td>
                                        <td>
                                            <!-- Edit button -->
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editModal-{{ $level->id }}">Edit</button>

                                            <!-- Delete form -->
                                            <form action="{{ route('admin.academic_levels.destroy', $level->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal-{{ $level->id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Academic Level</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.academic_levels.update', $level->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" value="{{ $level->name }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="abb" class="form-label">Abbreviation</label>
                                                            <input type="text" class="form-control" id="abb"
                                                                name="abb" value="{{ $level->abb }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="description" class="form-label">Description</label>
                                                            <textarea class="form-control" id="description" name="description">{{ $level->description }}</textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Add New Academic Level</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.academic_levels.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="abb" class="form-label">Abbreviation</label>
                            <input type="text" class="form-control" id="abb" name="abb">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Academic Level</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Optional: Include Bootstrap JS for modals functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
