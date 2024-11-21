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
                        <div class="table-responsive">
                            <table class="table table-striped datatable ">
                                <thead>
                                    <th>Catégorie</th>
                                    <th>Nom</th>
                                    <th>Module</th>
                                    <th>Filière</th>
                                    <th>Université</th>
                                    <th>Fichier</th>
                                    <th>Taille</th>
                                    <th>Téléchargements</th>
                                    <th>Uploader le</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($resources as $resource)
                                        <tr>
                                            <td>
                                                <span
                                                    class="badge text-bg-primary rounded-pill">{{ $resource->category->name }}</span>
                                            </td>
                                            <td>{{ $resource->name }}</td>
                                            <td>{{ $resource->courseModule->name }}</td>
                                            <td>{{ $resource->academicProgram->name }}
                                                ({{ $resource->academicLevel->name }})
                                            </td>
                                            <td>{{ $resource->university->name }}</td>
                                            <td>
                                                <a
                                                    href="{{ route('public.resource.download', $resource->id) }}">Télécharger</a>
                                                <br>
                                                <a href="{{ route('public.resource.view', $resource) }}">Voir</a>
                                            </td>
                                            <td>{{ $resource->getFileSize(format: true) }}</td>
                                            <td>{{ $resource->download_count }}</td>
                                            <td>{{ $resource->created_at->format('d M y') }}</td>

                                            @if ($resource->created_by_id === Auth::id() || Auth::user()->isAdmin())
                                                <td>
                                                    <a href="{{ route('admin.resources.edit', $resource->id) }}"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                    <form action="{{ route('admin.resources.destroy', $resource->id) }}"
                                                        method="POST" style="display: inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Ete vous surs de vouloir supprimer cette resource ?')"
                                                            class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            @endif

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination links (if applicable) -->
                        {{-- {{ $resources->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
