@extends('admin.layouts.app')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('content')
    {{-- @dump($errors->all()) --}}
    <div class="pagetitle">
        <h1>Ajouter un Uploader</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.uploaders.index') }}">Uploaders</a></li>
                <li class="breadcrumb-item active">Ajouter</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body pt-3">
                <div class="container">
                    <form action="{{ route('admin.uploaders.store') }}" method="POST">
                        @csrf
                        <x-user-form :user="null" />
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="universities" class="form-label">Université</label>
                                <select class="form-select @error('university_id') is-invalid @enderror" id="universities"
                                    name="university_id">
                                    <option value="0" @selected(true) @disabled(true)>
                                        Sélectionnez une Université</option>
                                    @foreach ($universities as $university)
                                        <option value="{{ $university->id }}" @selected(old('university_id') == $university->id)>
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
                                        <option value="{{ $level->id }}" @selected(old('academic_level_id') == $level->id)>
                                            {{ $level->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('academic_level_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <div class="col-md-6 mb-3">
                                <label for="academic_programs" class="form-label">Filiere</label>
                                <select class="form-select @error('academic_program_id') is-invalid @enderror"
                                    id="academic_programs" name="academic_program_id">
                                    <option value="">Sélectionnez une Filiere</option>
                                    @foreach ($academicPrograms as $program)
                                        <option value="{{ $program->id }}" @selected(old('academic_program_id') == $program->id)>
                                            {{ $program->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('academic_program_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}

                            <div class="col-md-6 mb-3 {{ old('academic_program_id') ? '' : 'd-none' }}">
                                <label for="academic_programs" class="form-label">Filiere</label>
                                <select class="form-select @error('academic_program_id') is-invalid @enderror"
                                    id="academic_programs" name="academic_program_id">
                                    <option value="0" @selected(true) @disabled(true)>
                                        Sélectionnez une Filiere</option>
                                </select>
                                @error('academic_program_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Créer Uploader</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- // initializeSelect2Fields(@json(config('app.url'))); --}}

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/admin/js/uploder-create.js') }}"></script>
    <script>
        $(document).ready(function() {
            uploaderCreate('{{ config('app.url') }}/api');
        });
    </script>
@endsection
