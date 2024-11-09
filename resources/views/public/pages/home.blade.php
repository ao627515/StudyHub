@extends('public.layouts.app')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('content')
    <section class="wrapper bg-dark angled lower-start">
        <div class="container pt-7 pt-md-11 pb-8">
            <div class="row gx-0 gy-10 align-items-center">
                <div class="col-lg-6" data-cues="slideInDown" data-group="page-title" data-delay="600">
                    <h1 class="display-1 text-white mb-4">StudyHub centralise les ressources académiques de <br /><span
                            class="typer text-primary text-nowrap" data-delay="100"
                            data-words="diverses universités,filères,modules,cours"></span><span class="cursor text-primary"
                            data-owner="typer"></span></h1>
                    <p class="lead fs-24 lh-sm text-white mb-7 pe-md-18 pe-lg-0 pe-xxl-15">Une plateforme centralisée pour
                        faciliter l'accès aux ressources académiques des universités, afin de soutenir l'apprentissage et la
                        réussite des étudiants.</p>
                    <div>
                        <a class="btn btn-lg btn-primary rounded">Commencer</a>
                    </div>
                </div>
                <!-- /column -->
                <div class="col-lg-5 offset-lg-1 mb-n18" data-cues="slideInDown">
                    <div class="position-relative">
                        <a href="./assets/media/movie.mp4"
                            class="btn btn-circle btn-primary btn-play ripple mx-auto mb-6 position-absolute"
                            style="top:50%; left: 50%; transform: translate(-50%,-50%); z-index:3;" data-glightbox><i
                                class="icn-caret-right"></i></a>
                        <figure class="rounded shadow-lg"><img src="./assets/img/photos/about13.jpg"
                                srcset="./assets/img/photos/about13@2x.jpg 2x" alt=""></figure>
                    </div>
                    <!-- /div -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <!-- /section -->
    <section class="wrapper bg-light">
        <div class="container pt-19 pt-md-21 pb-16 pb-md-18">
            <div class="row">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <h2 class="fs-16 text-uppercase text-line text-primary mb-3">Ce que nous faisons</h2>
                    <h3 class="display-4 mb-9">Notre application permet de centraliser les ressources académiques pour une
                        accessibilité facile et rapide.</h3>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
            <div class="row gx-md-8 gy-8 mb-14 mb-md-18">
                <div class="col-md-6 col-lg-3">
                    <div class="icon btn btn-block btn-lg btn-soft-primary pe-none mb-6"> <i
                            class="uil uil-phone-volume"></i> </div>
                    <h4>Support 24/7</h4>
                    <p class="mb-3">Notre équipe est disponible à tout moment pour vous assister dans votre navigation et
                        répondre à vos besoins.</p>
                    <a href="#" class="more hover link-primary">En savoir plus</a>
                </div>
                <!--/column -->
                <div class="col-md-6 col-lg-3">
                    <div class="icon btn btn-block btn-lg btn-soft-primary pe-none mb-6"> <i
                            class="uil uil-shield-exclamation"></i> </div>
                    <h4>Paiements sécurisés</h4>
                    <p class="mb-3">Nous garantissons un environnement sécurisé pour vos transactions, avec des paiements
                        cryptés et protégés.</p>
                    <a href="#" class="more hover link-primary">En savoir plus</a>
                </div>
                <!--/column -->
                <div class="col-md-6 col-lg-3">
                    <div class="icon btn btn-block btn-lg btn-soft-primary pe-none mb-6"> <i
                            class="uil uil-laptop-cloud"></i> </div>
                    <h4>Mises à jour quotidiennes</h4>
                    <p class="mb-3">Nous mettons régulièrement à jour les ressources pour vous offrir un accès aux
                        documents les plus récents.</p>
                    <a href="#" class="more hover link-primary">En savoir plus</a>
                </div>
                <!--/column -->
                <div class="col-md-6 col-lg-3">
                    <div class="icon btn btn-block btn-lg btn-soft-primary pe-none mb-6"> <i class="uil uil-chart-line"></i>
                    </div>
                    <h4>Analyse de marché</h4>
                    <p class="mb-3">Nous analysons les tendances du marché académique pour vous fournir les ressources les
                        plus pertinentes et actuelles.</p>
                    <a href="#" class="more hover link-primary">En savoir plus</a>
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
            <div class="row">
                <div class="offset-lg-8 col-lg-8 col-xl-7 col-xxl-6">
                    <h2 class="fs-16 text-uppercase text-line text-primary mb-3">D'où proviennent nos ressources ?</h2>
                </div>
                <div class="col-12">
                    <h3 class="display-4 mb-9">Les ressources disponibles sur notre plateforme proviennent des meilleures
                        universités et sont organisées de manière à répondre aux besoins de chaque utilisateur.</h3>
                </div>
                <!-- /column -->
            </div>
            <!--/.row -->
            <div class="row gy-10 gy-sm-13 gx-lg-3 align-items-center">
                @foreach ($universities as $university)
                    <div class="col-md-6 col-lg-4">
                        <div class="card" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4 p-5 align-item-center d-flex justify-content-center">
                                    <img src="{{ $university->getLogoUrl() }}" class="img-fluid rounded-start d-block w-100"
                                        alt="Logo de l'université">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $university->name }}</h6>
                                        <div class="my-2">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="uil uil-download-alt"></i>
                                                <span>{{ $university->resources_count }} ressources disponibles</span>
                                            </div>
                                        </div>
                                        <a href="#" class="btn btn-primary btn-sm">Voir les ressources</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/column -->
                @endforeach
            </div>
            <!--/.row -->
            <div class="mb-16 mt-8 mb-md-18 d-flex justify-content-center align-items-center">
                <button class="btn btn-primary">Voir plus</button>
            </div>
            <!--/.row -->
            <div class="row gy-10 mb-16 gy-sm-13 gx-lg-3 align-items-center">
                <div class="col">
                    <h2 class="fs-16 text-uppercase text-line text-primary mb-3">Les ressources les plus téléchargées</h2>
                    <h3 class="display-4 mb-7">Découvrez les ressources les plus populaires et les plus téléchargées par nos
                        utilisateurs.</h3>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <th>Catégorie</th>
                                <th>Nom</th>
                                <th>Module</th>
                                <th>Filière</th>
                                <th>Université</th>
                                <th>Télécharger</th>
                                <th>Taille</th>
                                <th>Nombre de téléchargements</th>
                                <th>Uploader le</th>
                            </thead>
                            <tbody>
                                @foreach ($moreResourcesDownload as $resource)
                                    <tr>
                                        <td>
                                            <span
                                                class="badge gradient-7 rounded-pill">{{ $resource->category->name }}</span>
                                        </td>
                                        <td>{{ $resource->name }}</td>
                                        <td>{{ $resource->courseModule->name }}</td>
                                        <td>{{ $resource->academicProgram->name }} ({{ $resource->academicLevel->name }})
                                        </td>
                                        <td>{{ $resource->university->name }}</td>
                                        <td>
                                            <a href="{{ route('public.resource.download', $resource->id) }}">Télécharger</a>
                                        </td>
                                        <td>{{ $resource->getFileSize(format: true) }}</td>
                                        <td>{{ $resource->download_count }}</td>
                                        <td>{{ $resource->created_at->format('d M y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
            <div class="row">
                <div class="offset-lg-8 col-lg-8 col-xl-7 col-xxl-6">
                    <h2 class="fs-16 text-uppercase text-line text-primary mb-3">Trouvez la ressource que vous cherchez</h2>
                </div>
                <div class="col-12">
                    <h3 class="display-4 mb-9">Utilisez notre fonctionnalité de recherche pour filtrer les ressources selon
                        vos besoins spécifiques.</h3>
                </div>
                <!-- /column -->
            </div>
            <!--/.row -->
            <div class="row gy-10 gy-sm-13 gx-lg-3 align-items-center">
                <form action="" methods="get">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="university" class="form-label">Université</label>
                                <select class="form-select" id="university" name="university" aria-label="Université">
                                    <option selected>Choisir l'université</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="program" class="form-label">Filière (Veuillez choisir une universite en
                                    1er)</label>
                                <select class="form-select" id="program" name="program" aria-label="Filière">
                                    <option selected>Choisir la filière</option>
                                    <option>Veuillez selectionner une universite en 1er</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="level" class="form-label">Niveau</label>
                                <select class="form-select" id="level" aria-label="Niveau academique">
                                    <option selected>Choisir le Niveau</option>
                                    @foreach ($levels as $level)
                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category" class="form-label">Categorie</label>
                                <select class="form-select" id="category" aria-label="Categorie de resource">
                                    <option selected>Choisir la categorie</option>
                                    @foreach ($resourceCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary mt-6" type="submit">Rechercher</button>
                    </div>
                </form>
            </div>
            <!--/.row -->
        </div>
    </section>

    <!-- /section -->
    <section class="wrapper image-wrapper bg-image bg-overlay" data-image-src="./assets/img/photos/bg1.jpg">
        <div class="container py-18">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="fs-16 text-uppercase text-line text-white mb-3">Rejoignez StudyHub</h2>
                    <h3 class="display-4 mb-6 text-white pe-xxl-18">Des milliers d'étudiants et d'enseignants nous font
                        confiance pour accéder facilement aux ressources académiques essentielles. Rejoignez-les pour
                        enrichir vos connaissances.</h3>
                    <a href="https://wa.me/?text=Bonjour!%20Je%20souhaite%20en%20savoir%20plus%20sur%20StudyHub."
                        target="_blank" class="btn btn-white rounded mb-0 text-nowrap">
                        Nous Contacter sur WhatsApp
                    </a>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->

    {{-- <section class="wrapper bg-light angled upper-end">
        <div class="container py-14 py-md-16">
            <div class="row">
                <div class="col-lg-9 col-xl-8 col-xxl-7">
                    <h2 class="fs-16 text-uppercase text-line text-primary mb-3">Case Studies</h2>
                    <h3 class="display-4 mb-9">Check out some of our awesome projects with creative ideas and great design.
                    </h3>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
            <div class="swiper-container blog grid-view mb-10" data-margin="30" data-dots="true" data-items-xl="3"
                data-items-md="2" data-items-xs="1">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <article>
                                <figure class="overlay overlay-1 hover-scale rounded mb-6"><a href="#"> <img
                                            src="./assets/img/photos/b4.jpg" alt="" /></a>
                                    <figcaption>
                                        <h5 class="from-top mb-0">Read More</h5>
                                    </figcaption>
                                </figure>
                                <div class="post-header">
                                    <h2 class="post-title h3 mb-3"><a class="link-dark" href="./blog-post.html">Ligula
                                            tristique quis risus</a></h2>
                                </div>
                                <!-- /.post-header -->
                                <div class="post-footer">
                                    <ul class="post-meta">
                                        <li class="post-date"><i class="uil uil-calendar-alt"></i><span>14 Apr 2022</span>
                                        </li>
                                        <li class="post-comments"><a href="#"><i
                                                    class="uil uil-file-alt fs-15"></i>Coding</a></li>
                                    </ul>
                                    <!-- /.post-meta -->
                                </div>
                                <!-- /.post-footer -->
                            </article>
                            <!-- /article -->
                        </div>
                        <!--/.swiper-slide -->
                        <div class="swiper-slide">
                            <article>
                                <figure class="overlay overlay-1 hover-scale rounded mb-6"><a href="#"> <img
                                            src="./assets/img/photos/b5.jpg" alt="" /></a>
                                    <figcaption>
                                        <h5 class="from-top mb-0">Read More</h5>
                                    </figcaption>
                                </figure>
                                <div class="post-header">
                                    <h2 class="post-title h3 mb-3"><a class="link-dark" href="./blog-post.html">Nullam id
                                            dolor elit id nibh</a></h2>
                                </div>
                                <!-- /.post-header -->
                                <div class="post-footer">
                                    <ul class="post-meta">
                                        <li class="post-date"><i class="uil uil-calendar-alt"></i><span>29 Mar 2022</span>
                                        </li>
                                        <li class="post-comments"><a href="#"><i
                                                    class="uil uil-file-alt fs-15"></i>Workspace</a></li>
                                    </ul>
                                    <!-- /.post-meta -->
                                </div>
                                <!-- /.post-footer -->
                            </article>
                            <!-- /article -->
                        </div>
                        <!--/.swiper-slide -->
                        <div class="swiper-slide">
                            <article>
                                <figure class="overlay overlay-1 hover-scale rounded mb-6"><a href="#"> <img
                                            src="./assets/img/photos/b6.jpg" alt="" /></a>
                                    <figcaption>
                                        <h5 class="from-top mb-0">Read More</h5>
                                    </figcaption>
                                </figure>
                                <div class="post-header">
                                    <h2 class="post-title h3 mb-3"><a class="link-dark" href="./blog-post.html">Ultricies
                                            fusce porta elit</a></h2>
                                </div>
                                <!-- /.post-header -->
                                <div class="post-footer">
                                    <ul class="post-meta">
                                        <li class="post-date"><i class="uil uil-calendar-alt"></i><span>26 Feb 2022</span>
                                        </li>
                                        <li class="post-comments"><a href="#"><i
                                                    class="uil uil-file-alt fs-15"></i>Meeting</a></li>
                                    </ul>
                                    <!-- /.post-meta -->
                                </div>
                                <!-- /.post-footer -->
                            </article>
                            <!-- /article -->
                        </div>
                        <!--/.swiper-slide -->
                        <div class="swiper-slide">
                            <article>
                                <figure class="overlay overlay-1 hover-scale rounded mb-6"><a href="#"> <img
                                            src="./assets/img/photos/b7.jpg" alt="" /></a>
                                    <figcaption>
                                        <h5 class="from-top mb-0">Read More</h5>
                                    </figcaption>
                                </figure>
                                <div class="post-header">
                                    <h2 class="post-title h3 mb-3"><a class="link-dark" href="./blog-post.html">Morbi leo
                                            risus porta eget</a></h2>
                                </div>
                                <div class="post-footer">
                                    <ul class="post-meta">
                                        <li class="post-date"><i class="uil uil-calendar-alt"></i><span>7 Jan 2022</span>
                                        </li>
                                        <li class="post-comments"><a href="#"><i
                                                    class="uil uil-file-alt fs-15"></i>Business Tips</a></li>
                                    </ul>
                                    <!-- /.post-meta -->
                                </div>
                                <!-- /.post-footer -->
                            </article>
                            <!-- /article -->
                        </div>
                        <!--/.swiper-slide -->
                    </div>
                    <!-- /.swiper-wrapper -->
                </div>
                <!-- /.swiper -->
            </div>
            <!-- /.swiper-container -->
        </div>
        <!-- /.container -->
    </section> --}}
    <!-- /section -->
    <section class="wrapper bg-soft-primary angled upper-end">
        <div class="container py-14 pt-md-17 pb-md-21">
            <div class="row gx-lg-8 gx-xl-12 gy-10 gy-lg-0 mb-2 align-items-end">
                <div class="col-lg-4">
                    <h2 class="fs-16 text-uppercase text-line text-primary mb-3">Prenez Contact</h2>
                    <h3 class="display-4 mb-0 pe-xxl-15">Nous serions ravis de vous entendre</h3>
                    <p class="mt-4">Veuillez partager vos pensées, questions ou commentaires avec nous.</p>
                </div>
                <div class="col-lg-8 mt-lg-2">
                    <form action="/submit-feedback" method="POST" class="feedback-form">
                        <div class="row gx-3 gy-3">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Votre Nom"
                                    required />
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="Votre Email"
                                    required />
                            </div>
                            <div class="col-12">
                                <textarea name="message" class="form-control" placeholder="Votre Message" rows="5" required></textarea>
                            </div>
                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="btn btn-primary rounded">Envoyer le Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="wrapper bg-light angled upper-end lower-start">
        <div class="container py-16 py-md-18 position-relative">
            <div class="position-relative mb-16">
                <div class="card shadow-lg">
                    <div class="row gx-0">
                        <div class="col-lg-6 image-wrapper bg-image bg-cover rounded-top rounded-lg-start"
                            style="background-image: url('./assets/img/photos/contact.jpg');">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-10 p-md-11 p-lg-13">
                                <h2 class="fs-16 text-uppercase text-line text-primary mb-3">Informations de Contact</h2>
                                <h3 class="display-4 mb-4">Connectez-vous avec nous</h3>
                                <p>Nous sommes ici pour vous aider et répondre à toutes vos questions. Nous avons hâte de
                                    vous entendre !</p>
                                <div class="d-flex flex-row mt-4">
                                    <div class="icon text-primary fs-28 me-4"><i class="uil uil-phone-volume"></i></div>
                                    <div>
                                        <h5 class="mb-1">Téléphone</h5>
                                        <p>00 (123) 456 78 90</p>
                                    </div>
                                </div>
                                <div class="d-flex flex-row mt-4">
                                    <div class="icon text-primary fs-28 me-4"><i class="uil uil-envelope"></i></div>
                                    <div>
                                        <h5 class="mb-1">Email</h5>
                                        <p>info@company.com</p>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <a href="https://wa.me/your-number" target="_blank" class="btn btn-success rounded">
                                        Contactez-nous sur WhatsApp
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- /section -->
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/public/js/home.js') }}"></script>
    <script>
        $(document).ready(function() {
            home({
                endpoint: '{{ config('app.url') }}/api/universities',
                relations: {
                    relations: 'academicPrograms'
                }
            });
        });
    </script>,
@endsection
