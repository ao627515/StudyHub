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
                <form action="{{ route('public.resources.seachAdvance') }}" methods="get">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="university" class="form-label">Université</label>
                                <select class="form-select" id="university" name="university" aria-label="Université"
                                    required>
                                    <option selected value="0">Tout</option>
                                    @foreach ($universities as $university)
                                        <option value="{{ $university->id }}">{{ $university->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="program" class="form-label">Filière (Veuillez choisir une universite en
                                    1er)</label>
                                <select class="form-select" id="program" name="program" aria-label="Filière">
                                    <option selected value="0">Tout</option>
                                    @foreach ($programs as $program)
                                        <option value="{{ $program->id }}">{{ $program->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="level" class="form-label">Niveau</label>
                                <select class="form-select" id="level" aria-label="Niveau academique">
                                    <option selected value="0">Tout</option>
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
                                    <option selected value="0">Tout</option>
                                    @foreach ($resourceCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category" class="form-label">Modules</label>
                                <select class="form-select" id="module" name="module"required>
                                    <option selected value="0">Tout</option>
                                    @foreach ($modules as $module)
                                        <option value="{{ $module->id }}">{{ $module->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category" class="form-label">Annees scholaire</label>
                                <select class="form-select" id="school_year" name="school_year"required>
                                    <option selected value="0">Tout</option>
                                    @foreach ($schoolYears as $schoolYear)
                                        <option value="{{ $schoolYear }}">{{ $schoolYear }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category" class="form-label">Nom de la resource</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary mt-6" type="submit">Rechercher</button>
                    </div>
                </form>
            </div>
            <!--/.row -->

            <div class="row gy-10 mb-16 gy-sm-13 gx-lg-3 align-items-center ">
                <div class="col">
                    <h2 class="fs-16 text-uppercase text-line text-primary mb-3">Les ressources les plus téléchargées</h2>
                    <h3 class="display-4 mb-7">Découvrez les ressources les plus populaires et les plus téléchargées par nos
                        utilisateurs.</h3>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped datatable">
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
                        </div>
                    </div>
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
    {{-- <script src="{{ asset('assets/public/js/search_advance.js') }}"></script>
    <script>
        $(document).ready(function() {
            searchAdvance({
                apiUrl: '{{ config('app.url') }}',
                params: {
                    relations: "academicPrograms.academicLevels"
                }
            });
        });
    </script> --}}
@endsection
