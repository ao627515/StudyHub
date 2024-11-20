<form action="{{ route('public.resources.seachAdvance') }}" method="get">
    <input type="hidden" name="layout" value="{{ $params['layout'] }}">
    <div class="row g-4">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="university" class="form-label">Université</label>
                <select class="form-select" id="university" name="university" aria-label="Université" required>
                    <option value="0" {{ old('university', $params['university']) == '0' ? 'selected' : '' }}>Tout
                    </option>
                    @foreach ($universities as $university)
                        <option value="{{ $university->id }}"
                            {{ old('university', $params['university']) == $university->id ? 'selected' : '' }}>
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
                    <option value="0" {{ old('program', $params['program']) == '0' ? 'selected' : '' }}>Tout
                    </option>
                    @foreach ($programs as $program)
                        <option value="{{ $program->id }}"
                            {{ old('program', $params['program']) == $program->id ? 'selected' : '' }}>
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
                    <option value="0" {{ old('level', $params['level']) == '0' ? 'selected' : '' }}>
                        Tout</option>
                    @foreach ($levels as $level)
                        <option value="{{ $level->id }}"
                            {{ old('level', $params['level']) == $level->id ? 'selected' : '' }}>
                            {{ $level->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="category" class="form-label">Catégorie</label>
                <select class="form-select" id="category" name="category" aria-label="Catégorie de ressource">
                    <option value="0" {{ old('category', $params['category']) == '0' ? 'selected' : '' }}>Tout
                    </option>
                    @foreach ($resourceCategories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category', $params['category']) == $category->id ? 'selected' : '' }}>
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
                    <option value="0" {{ old('module', $params['module']) == '0' ? 'selected' : '' }}>
                        Tout</option>
                    @foreach ($modules as $module)
                        <option value="{{ $module->id }}"
                            {{ old('module', $params['module']) == $module->id ? 'selected' : '' }}>
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
                    <option value="0" {{ old('school_year', $params['school_year']) == '0' ? 'selected' : '' }}>
                        Tout
                    </option>
                    @foreach ($schoolYears as $schoolYear)
                        <option value="{{ $schoolYear }}"
                            {{ old('school_year', $params['school_year']) == $schoolYear ? 'selected' : '' }}>
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
    </div>
</form>
