@extends('admin.layouts.app')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('content')
    @dump($errors->all())
    <div class="pagetitle">
        <h1>Modifier un Uploader</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.uploaders.index') }}">Uploaders</a></li>
                <li class="breadcrumb-item active">Modifier</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body pt-3">
                <div class="container">
                    <form action="{{ route('admin.uploaders.update', $uploader->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <x-user-form :user="$uploader" />
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="universities" class="form-label">Université</label>
                                <select class="form-select @error('university_id') is-invalid @enderror" id="universities"
                                    name="university_id">
                                    <option value="0" @disabled(true)>
                                        Sélectionnez une Université</option>
                                    @foreach ($universities as $university)
                                        <option value="{{ $university->id }}" @selected($uploader->university->id == $university->id)>
                                            {{ $university->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('university_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="academic_levels" class="form-label">Niveau académique</label>
                                <select class="form-select @error('academic_level_id') is-invalid @enderror"
                                    id="academic_levels" name="academic_level_id">
                                    <option value="0" @selected(true) @disabled(true)>
                                        Sélectionnez un Niveau Académique</option>
                                    @foreach ($academicLevels as $level)
                                        <option value="{{ $level->id }}" @selected($uploader->academicLevel->id == $level->id)>
                                            {{ $level->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('academic_level_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="academic_programs" class="form-label">Filière :
                                    {{ $uploader->academicProgram->name }}</label>
                                <select class="form-select @error('academic_program_id') is-invalid @enderror"
                                    id="academic_programs" name="academic_program_id">
                                    <option value="0" @disabled(true)>
                                        Sélectionnez une Filière</option>
                                </select>
                                @error('academic_program_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">Modifier Uploader</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fonction générique d'initialisation de Select2 avec création dynamique d'options

            // Initialisation des champs avec Select2
            initializeSelect2WithCreate({
                selectId: '#universities',
                apiUrl: 'http://127.0.0.1:8000/api/universities',
                newResourceData: {
                    name: () => $('.select2-search__field').val()
                },
                resource: 'university',
                placeholder: 'Search for a university...',
                noResultsMessage: 'No results found'
            });

            initializeSelect2WithCreate({
                selectId: '#academic_levels',
                apiUrl: 'http://127.0.0.1:8000/api/academic_levels',
                newResourceData: {
                    name: () => $('.select2-search__field').val()
                },
                resource: 'academic levels',
                placeholder: 'Search for an academic level...',
                noResultsMessage: 'No results found'
            });

            initializeSelect2WithCreate({
                selectId: '#academic_programs',
                apiUrl: '{{ config('app.url') }}/academic_programs',
                newResourceData: {
                    name: () => $('.select2-search__field').val(),
                    university_id: () => $('#universities').val()
                },
                resource: 'academic program',
                placeholder: 'Search for an academic program...',
                noResultsMessage: 'No results found',
                fetchOptions: function(apiUrl) {
                    return {
                        url: function() {
                            const universityId = $('#universities').val();
                            return `http://127.0.0.1:8000/api/universities/${universityId}`;
                        },
                        dataType: 'json',
                        delay: 250,
                        data: {
                            relations: ["academicPrograms"]
                        },
                        processResults: function(response) {
                            const programs = response.data.academicPrograms || [];
                            return {
                                results: programs.map(program => ({
                                    id: program.id,
                                    text: program.name
                                }))
                            };
                        },
                        cache: true
                    };
                },

                afterSelectCallback: function() {
                    $('#academic_programs').val(null).trigger('change');
                }
            });

            // Réinitialiser les programmes académiques chaque fois que l'université change
            $('#universities').on('change', function() {
                $('#academic_programs').val(null).trigger('change');
            });

            $('#academic_programs').val('{{ $uploader->academicProgram->id }}').trigger('change');
        });
    </script>
@endsection
