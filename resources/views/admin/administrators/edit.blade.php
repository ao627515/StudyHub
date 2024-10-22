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

                                <div class="row mb-3">
                                    <label for="lastname" class="col-sm-2 col-form-label">Nom</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="lastname"
                                            class="form-control @error('lastname') is-invalid @enderror" id="lastname"
                                            value="{{ old('lastname', $administrator->lastname) }}" required>
                                        @error('lastname')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="firstname" class="col-sm-2 col-form-label">Prénom</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="firstname"
                                            class="form-control @error('firstname') is-invalid @enderror" id="firstname"
                                            value="{{ old('firstname', $administrator->firstname) }}" required>
                                        @error('firstname')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="phone" class="col-sm-2 col-form-label">Téléphone</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror" id="phone"
                                            value="{{ old('phone', $administrator->phone) }}" required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror" id="email"
                                            value="{{ old('email', $administrator->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

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
