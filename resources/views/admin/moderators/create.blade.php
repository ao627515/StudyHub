@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Créer un Moderateur</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.administrators.index') }}">Moderateurs</a></li>
                <li class="breadcrumb-item active">Créer</li>
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
                            <h5 class="card-title">Informations sur l'moderateurs</h5>

                            <form method="POST" action="{{ route('admin.moderators.store') }}">
                                @csrf
                                <x-user-form :user="null" />
                                <div class="row mb-3">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button type="submit" class="btn btn-primary">Créer un moderateur</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection
