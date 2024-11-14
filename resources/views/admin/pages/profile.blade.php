@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Profil</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                <li class="breadcrumb-item">Utilisateurs</li>
                <li class="breadcrumb-item active">Profil</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    {{-- @dump($errors) --}}

    @if ($errors->updatePassword->any())
        <div class="alert alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <ul>
                @foreach ($errors->updatePassword->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @session('status')
        <div class="alert alert-info" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ $value }}
        </div>
    @endsession


    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="{{ asset('assets/global/img/ni5.png') }}" alt="Profil" class="rounded-circle img-fluid">
                        <h2>{{ $user->name }}</h2>
                        <h3>{{ Str::ucfirst($user->role->name) }}</h3>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Vue
                                    d'ensemble</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Modifier
                                    le Profil</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">Changer le Mot de Passe</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Détails du Profil</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nom Complet</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Téléphone</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->phone }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                </div>

                                @if ($user->isUploader())
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Unisersite</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->university }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Filiere</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->academicProgram }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Niveau</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->academicLevel }}</div>
                                    </div>
                                @endif

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Formulaire de modification du profil -->
                                <form action="{{ route('admin.profile.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row mb-3">
                                        <label for="lastname" class="col-md-4 col-lg-3 col-form-label">Nom</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="lastname" type="text" class="form-control" id="lastname"
                                                value="{{ old('lastname', $user->lastname) }}">
                                            @error('lastname')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="firstname" class="col-md-4 col-lg-3 col-form-label">Prénom</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="firstname" type="text" class="form-control" id="firstname"
                                                value="{{ old('firstname', $user->firstname) }}">
                                            @error('firstname')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label for="phone" class="col-md-4 col-lg-3 col-form-label">Téléphone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone" type="text" class="form-control" id="phone"
                                                value="{{ old('phone', $user->phone) }}">
                                            @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="email"
                                                value="{{ old('email', $user->email) }}">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Enregistrer les
                                            Modifications</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Formulaire de changement de mot de passe -->
                                <form action="{{ route('admin.password.update') }}" method="POST">
                                    @csrf
                                    @method('Put')
                                    <!-- Current Password -->
                                    <div class="row mb-3">
                                        <label for="current_password" class="col-md-4 col-lg-3 col-form-label">Current
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="current_password" type="password" class="form-control"
                                                id="current_password">
                                            @error('current_password', 'updatePassword')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- New Password -->
                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-lg-3 col-form-label">New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password" class="form-control" id="password">
                                            @error('password', 'updatePassword')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Confirm New Password -->
                                    <div class="row mb-3">
                                        <label for="password_confirmation"
                                            class="col-md-4 col-lg-3 col-form-label">Confirm New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password_confirmation" type="password" class="form-control"
                                                id="password_confirmation">
                                            @error('password_confirmation', 'updatePassword')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary mb-3">Changer le Mot de
                                            Passe</button>
                                        <br>
                                    </div>
                                </form><!-- End Change Password Form -->
                                <div class="text-center">

                                    <form action="{{ route('admin.password.email') }}" method="post"
                                        id="passwordForgot">
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-sm" form="passwordForgot">Mot
                                            de passe oublié
                                            ?</button>
                                    </form>
                                </div>

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
