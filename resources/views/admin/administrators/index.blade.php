@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Liste des Administrateurs</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Administrateurs</li>
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
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des Administrateurs</h5>

                        <div class="mb-3">
                            <a href="{{ route('admin.administrators.create') }}" class="btn btn-primary">Ajouter un
                                Administrateur</a>
                        </div>

                        <!-- Table des administrateurs -->
                        <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($administrators as $administrator)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $administrator->lastname }}</td>
                                        <td>{{ $administrator->firstname }}</td>
                                        <td>{{ $administrator->phone }}</td>
                                        <td>{{ $administrator->email }}</td>
                                        <td>
                                            <a href="{{ route('admin.administrators.edit', $administrator->id) }}"
                                                class="btn btn-warning btn-sm">Modifier</a>
                                            <form action="{{ route('admin.administrators.destroy', $administrator->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet administrateur ?');">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
