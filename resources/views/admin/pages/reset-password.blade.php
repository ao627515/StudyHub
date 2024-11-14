@extends('admin.layouts.guest')

@section('content')
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                {{-- <img src="assets/img/logo.png" alt=""> --}}
                                <span class="d-none d-lg-block">StudentHub</span>
                            </a>
                        </div><!-- Fin Logo -->

                        {{-- @dump($errors) --}}
                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Recupérez-vous à votre compte</h5>
                                    <p class="text-center small">Saisissez votre identifiant et mot de passe pour vous
                                        connecter</p>
                                </div>

                                <!-- Formulaire de connexion avec gestion des erreurs Laravel -->
                                <form method="POST" action="{{ route('password.store') }}" class="row g-3 needs-validation"
                                    novalidate>
                                    @csrf


                                    <input type="hidden" name="token" value="{{ $request->token }}">

                                    <div class="col-12">
                                        <label for="" class="form-label">Identifiant</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" name="email"
                                                class="form-control @error('email') is-invalid @enderror" id="yourLogin"
                                                placeholder="Email" value="{{ old('email', $request->email) }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Mot de passe</label>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror" id="yourPassword"
                                            required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Mot de passe confirmé </label>
                                        <input type="password" name="password_confirmation"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            id="yourPassword" required>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Connexion</button>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <div class="credits">
                            Conçu par odg-developpement
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
