@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Resource Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Resources</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Resources List</h5>

                        <!-- Button to open the creation modal or link to the creation page -->
                        <a href="{{ route('admin.resources.create') }}" class="btn btn-success mb-3">
                            Add New Resource
                        </a>

                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>File URL</th>
                                    <th>Version</th>
                                    <th>Download count</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($resources as $resource)
                                    <tr>
                                        <td>{{ $resource->name }}</td>
                                        <td>{{ $resource->description ?? 'N/A' }}</td>
                                        <td><a href="{{ $resource->getFileUrl() }}" target="_blank">View File</a></td>
                                        <td>{{ $resource->version }}</td>
                                        <td>{{ $resource->download_count }}</td>
                                        <td>
                                            <!-- Link to edit the resource -->
                                            <a href="{{ route('admin.resources.edit', $resource) }}"
                                                class="btn btn-primary btn-sm">Edit</a>

                                            <form action="{{ route('admin.resources.destroy', $resource) }}" method="POST"
                                                style="display: inline;">
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

                        <!-- Pagination links (if applicable) -->
                        {{-- {{ $resources->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
