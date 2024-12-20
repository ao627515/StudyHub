@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Modifier un Administrateur</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.administrators.index') }}">Administrateurs</a></li>
                <li class="breadcrumb-item active">Modifier</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Informations sur l'administrateur</h5>

                            <form method="POST" action="{{ route('admin.administrators.update', $administrator->id) }}">
                                @csrf
                                @method('PUT') <!-- Méthode PUT pour la mise à jour -->

                                <x-user-form :user="$administrator" />

                                <div class="row mb-3">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button type="submit" class="btn btn-primary">Mettre à jour
                                            l'administrateur</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
