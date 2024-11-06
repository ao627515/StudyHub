@extends('public.layouts.app')

@section('content')
    <section class="wrapper bg-dark angled lower-start">
        <div class="container pt-7 pt-md-11 pb-8">
            <div class="row gx-0 gy-10 align-items-center">
                <div class="col-lg-6" data-cues="slideInDown" data-group="page-title" data-delay="600">
                    <h1 class="display-1 text-white mb-4">Notre plateforme se concentre sur <br /><span
                            class="typer text-primary text-nowrap" data-delay="100"
                            data-words="l'accès aux ressources, l'éducation pour tous, le soutien aux étudiants"></span><span
                            class="cursor text-primary" data-owner="typer"></span></h1>
                    <p class="lead fs-24 lh-sm text-white mb-7 pe-md-18 pe-lg-0 pe-xxl-15">Nous fournissons des ressources
                        académiques pour chaque étape de votre parcours d'apprentissage.</p>
                    <div>
                        <a class="btn btn-lg btn-primary rounded">Commencer</a>
                    </div>
                </div>
                <!-- /column -->
                <div class="col-lg-5 offset-lg-1 mb-n18" data-cues="slideInDown">
                    <div class="position-relative">
                        <figure class="rounded shadow-lg"><img src="./assets/img/photos/resource.jpg"
                                srcset="./assets/img/photos/resource@2x.jpg 2x" alt="Ressources Académiques"></figure>
                    </div>
                    <!-- /div -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <section class="wrapper bg-light">
        <div class="container pt-19 pt-md-21 pb-16 pb-md-18">
            <div class="row">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <h2 class="fs-16 text-uppercase text-line text-primary mb-3">Nos Services</h2>
                    <h3 class="display-4 mb-9">Un service conçu pour répondre aux besoins des étudiants.</h3>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
            <div class="row gx-md-8 gy-8 mb-14 mb-md-18">
                <div class="col-md-6 col-lg-3">
                    <div class="icon btn btn-block btn-lg btn-soft-primary pe-none mb-6"> <i class="uil uil-clock"></i>
                    </div>
                    <h4>Support Disponible</h4>
                    <p class="mb-3">Notre équipe est là pour répondre à vos questions 24h/24 et 7j/7.</p>
                    <a href="#" class="more hover link-primary">En savoir plus</a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="icon btn btn-block btn-lg btn-soft-primary pe-none mb-6"> <i class="uil uil-lock-alt"></i>
                    </div>
                    <h4>Accès Sécurisé</h4>
                    <p class="mb-3">Vos données et vos ressources sont protégées par nos mesures de sécurité avancées.</p>
                    <a href="#" class="more hover link-primary">En savoir plus</a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="icon btn btn-block btn-lg btn-soft-primary pe-none mb-6"> <i
                            class="uil uil-cloud-upload"></i> </div>
                    <h4>Mises à Jour Quotidiennes</h4>
                    <p class="mb-3">Accédez aux nouvelles ressources ajoutées chaque jour pour enrichir votre
                        apprentissage.</p>
                    <a href="#" class="more hover link-primary">En savoir plus</a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="icon btn btn-block btn-lg btn-soft-primary pe-none mb-6"> <i class="uil uil-chart-bar"></i>
                    </div>
                    <h4>Ressources Variées</h4>
                    <p class="mb-3">Retrouvez une grande diversité de ressources pour soutenir votre parcours académique.
                    </p>
                    <a href="#" class="more hover link-primary">En savoir plus</a>
                </div>
            </div>
        </div>
    </section>

    <section class="wrapper image-wrapper bg-image bg-overlay" data-image-src="./assets/img/photos/community.jpg">
        <div class="container py-18">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="fs-16 text-uppercase text-line text-white mb-3">Rejoignez notre Communauté</h2>
                    <h3 class="display-4 mb-6 text-white pe-xxl-18">Plus de 5000 utilisateurs nous font confiance.
                        Rejoignez-nous pour faciliter votre accès aux ressources académiques.</h3>
                    <a href="#" class="btn btn-white rounded mb-0 text-nowrap">Rejoignez-nous</a>
                </div>
            </div>
        </div>
    </section>
@endsection
