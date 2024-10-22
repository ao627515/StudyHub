@extends('admin.layouts.app')

@section('content')
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
                                <label for="university_id" class="form-label">Université</label>
                                <select class="form-select @error('university_id') is-invalid @enderror" id="university_id"
                                    name="university_id">
                                    <option value="">Sélectionnez une Université</option>
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
                                <label for="academic_level_id" class="form-label">Niveau académique</label>
                                <select class="form-select @error('academic_level_id') is-invalid @enderror"
                                    id="academic_level_id" name="academic_level_id">
                                    <option value="">Sélectionnez un Niveau Académique</option>
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

                            <div class="col-md-6 mb-3">
                                <label for="academic_program_id" class="form-label">Programme académique</label>
                                <select class="form-select @error('academic_program_id') is-invalid @enderror"
                                    id="academic_program_id" name="academic_program_id">
                                    <option value="">Sélectionnez un Programme Académique</option>
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
                        </div>

                        <button type="submit" class="btn btn-primary">Créer Uploader</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
