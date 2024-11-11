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
                    <h1 class="display-1 text-white mb-4">StudyHub centralise les ressources académiques de diverses
                        universités par<br /><span class="typer text-primary text-nowrap" data-delay="100"
                            data-words="filères,modules,annee scholaire"></span><span class="cursor text-primary"
                            data-owner="typer"></span></h1>
                    <p class="lead fs-24 lh-sm text-white mb-7 pe-md-18 pe-lg-0 pe-xxl-15">Une plateforme centralisée pour
                        faciliter l'accès aux ressources académiques des universités, afin de soutenir l'apprentissage et la
                        réussite des étudiants.</p>
                    <div>
                        <a href="#standardSearch" class="btn btn-lg btn-primary rounded">Commencer</a>
                    </div>
                </div>
                <!-- /column -->
                <div class="col-lg-5 offset-lg-1 mb-n18" data-cues="slideInDown">
                    <div class="position-relative">
                        <figure class="rounded shadow-lg"><img src="{{ asset('assets/public/img/hero.jpg') }}"
                                srcset="{{ asset('assets/public/img/hero.jpg') }}@2x.jpg 2x" alt=""></figure>
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
                <div class="offset-lg-8 col-lg-8 col-xl-7 col-xxl-6">
                    <h2 id="standardSearch" class="fs-16 text-uppercase text-line text-primary mb-3">Trouvez la ressource
                        que vous cherchez
                    </h2>
                </div>
                <div class="col-12">
                    <h3 class="display-6 mb-9">Utilisez notre fonctionnalité de recherche pour filtrer les ressources selon
                        vos besoins spécifiques.</h3>
                </div>
                <!-- /column -->
            </div>
            <!--/.row -->
            <div class="row gy-10 gy-sm-13 mb-16 gx-lg-3 align-items-center">
                <form action="{{ route('public.resources.seachAdvance') }}" method="get">
                    @csrf
                    <div class="row g-3">
                        <!-- Université -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="university" class="form-label text-dark">Université</label>
                                <select class="form-select" id="university" name="university" aria-label="Université">
                                    <option value="0" {{ request('university') == 0 ? 'selected' : '' }}>
                                        Choisir l'université</option>
                                    @foreach ($universities as $university)
                                        <option value="{{ $university->id }}"
                                            {{ request('university') == $university->id ? 'selected' : '' }}>
                                            {{ $university->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Filière -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="program" class="form-label text-dark">Filière</label>
                                <select class="form-select" id="program" name="program" aria-label="Filière">
                                    <option value="0" {{ request('program') == 0 ? 'selected' : '' }}>Choisir
                                        la filière</option>
                                    @foreach ($programs as $program)
                                        <option value="{{ $program->id }}"
                                            {{ request('program') == $program->id ? 'selected' : '' }}>
                                            {{ $program->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Niveau -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="level" class="form-label text-dark">Niveau</label>
                                <select class="form-select" id="level" name="level" aria-label="Niveau académique">
                                    <option value="0" {{ request('level') == 0 ? 'selected' : '' }}>Choisir le
                                        niveau</option>
                                    @foreach ($levels as $level)
                                        <option value="{{ $level->id }}"
                                            {{ request('level') == $level->id ? 'selected' : '' }}>
                                            {{ $level->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Catégorie -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category" class="form-label text-dark">Catégorie</label>
                                <select class="form-select" id="category" name="category"
                                    aria-label="Catégorie de ressource">
                                    <option value="0" {{ request('category') == 0 ? 'selected' : '' }}>Choisir
                                        la catégorie</option>
                                    @foreach ($resourceCategories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Boutons d'action centrés -->
                    <div class="d-flex justify-content-center mt-4">
                        <button class="btn btn-primary me-2" type="submit">Rechercher</button>
                    </div>
                </form>
            </div>
            <!--/.row -->
            <div class="row">
                <div class="offset-lg-8 col-lg-8 col-xl-7 col-xxl-6">
                    <h2 class="fs-16 text-uppercase text-line text-primary mb-3">D'où proviennent nos ressources ?</h2>
                </div>
                <div class="col-12">
                    <h3 class="display-6 mb-9">Les ressources de notre plateforme proviennent des meilleures universités
                    </h3>
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
                                    <img src="{{ $university->getLogoUrl() }}"
                                        class="img-fluid rounded-start d-block w-100" alt="Logo de l'université">
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
                                        <a href="{{ route('public.resources.seachAdvance', ['university' => $university->id]) }}"
                                            class="btn btn-primary btn-sm">Voir les ressources</a>
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
                <a href="{{ route('public.resources.seachAdvance') }}" class="btn btn-primary">Voir plus</a>
            </div>
            <!--/.row -->
            <div class="row gy-10 mb-16 gy-sm-13 gx-lg-3 align-items-center">
                <div class="col">
                    <h2 class="fs-16 text-uppercase text-line text-primary mb-3">Les ressources les plus téléchargées</h2>
                    <h3 class="display-4 mb-7">Découvrez les ressources les plus populaires et les plus téléchargées par
                        nos
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
                                <th>Téléchargements</th>
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
                                            <a
                                                href="{{ route('public.resource.download', $resource->id) }}">Télécharger</a>
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
        </div>
    </section>

    <!-- /section -->
    <section id="contact" class="wrapper image-wrapper bg-image bg-overlay"
        data-image-src="{{ asset('assets/public/img/bg3.jpg') }}">
        {{-- <img class="img-fluid" src="./assets/img/illustrations/ni2.png" alt="" /> --}}
        <div class="container py-18">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="fs-16 text-uppercase text-line text-white mb-3">Rejoignez StudyHub</h2>
                    <h3 class="display-4 mb-6 text-white pe-xxl-18">Étudiants et enseignants nous font confiance pour des
                        ressources académiques essentielles. Rejoignez-les!</h3>
                    <a href="https://wa.me/22673471085?text=Bonjour!%20Je%20souhaite%20en%20savoir%20plus%20sur%20StudyHub."
                        target="_blank" class="btn btn-success rounded mb-0 text-nowrap"
                        style="background-color: #25D366; color: white; border-color: #25D366;">
                        <i class="uil uil-whatsapp me-2 fs-30"></i> Nous Contacter
                    </a>
                </div>
            </div>
        </div>
    </section>

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
            home();
        });
    </script>
@endsection
