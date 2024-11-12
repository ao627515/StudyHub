@extends('public.layouts.app')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/simple-datatables/style.css') }}">
@endsection


@section('content')
    <section class="wrapper bg-light">
        <div class="container pt-9 pt-md-10 pb-6 pb-md-8">
            <div class="row">
                <div class="offset-lg-8 col-lg-8 col-xl-7 col-xxl-6">
                    <h2 class="fs-16 text-uppercase text-line text-primary mb-3">Trouvez la ressource que vous cherchez</h2>
                </div>
                <!-- /column -->
            </div>
            <!--/.row -->
            <div class="row gy-10 gy-sm-13 gx-lg-3 align-items-center">
                <form action="{{ route('public.resources.seachAdvance') }}" method="get">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="university" class="form-label">Université</label>
                                <select class="form-select" id="university" name="university" aria-label="Université"
                                    required>
                                    <option value="0" {{ old('university') == '0' ? 'selected' : '' }}>Tout</option>
                                    @foreach ($universities as $university)
                                        <option value="{{ $university->id }}"
                                            {{ old('university', request('university')) == $university->id ? 'selected' : '' }}>
                                            {{ $university->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="program" class="form-label">Filière</label>
                                <select class="form-select" id="program" name="program" aria-label="Filière">
                                    <option value="0"
                                        {{ old('program', request('program')) == '0' ? 'selected' : '' }}>Tout</option>
                                    @foreach ($programs as $program)
                                        <option value="{{ $program->id }}"
                                            {{ old('program', request('program')) == $program->id ? 'selected' : '' }}>
                                            {{ $program->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="level" class="form-label">Niveau</label>
                                <select class="form-select" id="level" name="level" aria-label="Niveau académique">
                                    <option value="0" {{ old('level', request('level')) == '0' ? 'selected' : '' }}>
                                        Tout</option>
                                    @foreach ($levels as $level)
                                        <option value="{{ $level->id }}"
                                            {{ old('level', request('level')) == $level->id ? 'selected' : '' }}>
                                            {{ $level->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category" class="form-label">Catégorie</label>
                                <select class="form-select" id="category" name="category"
                                    aria-label="Catégorie de ressource">
                                    <option value="0"
                                        {{ old('category', request('category')) == '0' ? 'selected' : '' }}>Tout</option>
                                    @foreach ($resourceCategories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category', request('category')) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="module" class="form-label">Module</label>
                                <select class="form-select" id="module" name="module" required>
                                    <option value="0" {{ old('module', request('module')) == '0' ? 'selected' : '' }}>
                                        Tout</option>
                                    @foreach ($modules as $module)
                                        <option value="{{ $module->id }}"
                                            {{ old('module', request('module')) == $module->id ? 'selected' : '' }}>
                                            {{ $module->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="school_year" class="form-label">Année scolaire</label>
                                <select class="form-select" id="school_year" name="school_year" required>
                                    <option value="0"
                                        {{ old('school_year', request('school_year')) == '0' ? 'selected' : '' }}>Tout
                                    </option>
                                    @foreach ($schoolYears as $schoolYear)
                                        <option value="{{ $schoolYear }}"
                                            {{ old('school_year', request('school_year')) == $schoolYear ? 'selected' : '' }}>
                                            {{ $schoolYear }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom de la ressource</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ old('name', request('name')) }}">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary mt-6 me-2" type="submit">Rechercher</button>
                        <a href="{{ route('public.resources.seachAdvance') }}" class="btn btn-info mt-6">
                            Réinitialiser
                        </a>
                        {{-- <button class="btn btn-info mt-6" type="reset">Réinitialiser</button> --}}
                    </div>
                </form>
                >
            </div>
            <!--/.row -->

            <div class="row gy-10 mb-16 gy-sm-13 gx-lg-3 align-items-center" id="ressources">
                <div class="col-12">
                    <h2 class="fs-16 text-uppercase text-line text-primary mb-3">Nos resources</h2>
                    {{-- <h3 class="display-4 mb-7">Découvrez les ressources les plus populaires et les plus téléchargées par nos
                        utilisateurs.</h3> --}}


                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <span class="me-2">Disposition :</span>
                            <a href="{{ route('public.resources.seachAdvance', ['layout' => 'list']) }}"
                                class="btn btn-sm {{ request('layout') === 'list' || !request()->has('layout') ? 'btn-primary' : 'btn-outline-primary' }}"
                                title="Vue liste">
                                <i class="uil uil-list-ul"></i>
                            </a>

                            <a href="{{ route('public.resources.seachAdvance', ['layout' => 'grid']) }}"
                                class="btn btn-sm ms-2 {{ request('layout') === 'grid' ? 'btn-primary' : 'btn-outline-primary' }}"
                                title="Vue en grille">
                                <i class="uil uil-apps"></i>
                            </a>
                        </div>

                        <div class="card-body">


                            @if (request('layout') == 'grid')
                                <div class="row">
                                    @foreach ($resources as $resource)
                                        <div class="col-md-4 mb-4">
                                            <div class="card h-100">
                                                <!-- Image de la ressource -->
                                                <img src="{{ $resource->getImageUrl() }}" class="card-img-top"
                                                    alt="Image de {{ $resource->name }}"
                                                    style="height: 200px; object-fit: cover;">

                                                <div class="card-body">
                                                    <!-- Nom et Catégorie -->
                                                    <h5 class="card-title">{{ $resource->name }}</h5>
                                                    <span
                                                        class="badge gradient-7 rounded-pill">{{ $resource->category->name }}</span>


                                                    <!-- Informations essentielles -->
                                                    <p class="card-text">
                                                        <strong>Module :</strong> {{ $resource->courseModule->name }} <br>
                                                        <strong>Filière :</strong> {{ $resource->academicProgram->name }}
                                                        ({{ $resource->academicLevel->name }})
                                                        <br>
                                                        <strong>Université :</strong> {{ $resource->university->name }}
                                                        <br>
                                                        <strong>Téléchargements :</strong> {{ $resource->download_count }}
                                                    </p>

                                                    <!-- Boutons d'actions -->
                                                    <button class="btn btn-sm btn-soft-blue" data-bs-toggle="modal"
                                                        data-bs-target="#resourceModal{{ $resource->id }}">
                                                        {{-- Voir plus --}}
                                                        <i class="uil uil-info-circle"></i>
                                                        {{-- <i class="uil uil-eye"></i> --}}
                                                    </button>
                                                    <a href="{{ route('public.resource.download', $resource->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        {{-- Télécharger --}}
                                                        <i class="uil uil-download-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal pour afficher les détails de la ressource -->
                                        <div class="modal fade" id="resourceModal{{ $resource->id }}" tabindex="-1"
                                            aria-labelledby="resourceModalLabel{{ $resource->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="resourceModalLabel{{ $resource->id }}">
                                                            {{ $resource->name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Catégorie :</strong> <span
                                                                class="badge gradient-7 rounded-pill">{{ $resource->category->name }}</span>
                                                        </p>
                                                        <p><strong>Module :</strong> {{ $resource->courseModule->name }}
                                                        </p>
                                                        <p><strong>Filière :</strong>
                                                            {{ $resource->academicProgram->name }}
                                                            ({{ $resource->academicLevel->name }})</p>
                                                        <p><strong>Université :</strong> {{ $resource->university->name }}
                                                        </p>
                                                        <p><strong>Taille :</strong>
                                                            {{ $resource->getFileSize(format: true) }}
                                                        </p>
                                                        <p><strong>Téléchargements :</strong>
                                                            {{ $resource->download_count }}
                                                        </p>
                                                        <p><strong>Date d'upload :</strong>
                                                            {{ $resource->created_at->format('d M y') }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ route('public.resource.download', $resource->id) }}"
                                                            class="btn btn-primary">
                                                            Télécharger
                                                        </a>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Fermer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped datatable">
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
                                        </thead>
                                        <tbody>
                                            @foreach ($resources as $resource)
                                                <tr>
                                                    <td>
                                                        <span
                                                            class="badge gradient-7 rounded-pill">{{ $resource->category->name }}</span>
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
                                                    </td>
                                                    <td>{{ $resource->getFileSize(format: true) }}</td>
                                                    <td>{{ $resource->download_count }}</td>
                                                    <td>{{ $resource->created_at->format('d M y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12">


                </div>
                <!--/column -->
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/admin/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/public/js/search_advance.js') }}"></script>
    <script>
        $(document).ready(function() {
            searchAdvance();
        });
    </script>
@endsection
