<div>
    <div class="row mb-3">
        <label for="lastname" class="col-sm-2 col-form-label">Nom</label>
        <div class="col-sm-10">
            <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror"
                id="lastname" value="{{ old('lastname', $user?->lastname) }}" required>
            @error('lastname')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="firstname" class="col-sm-2 col-form-label">Prénom</label>
        <div class="col-sm-10">
            <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror"
                id="firstname" value="{{ old('firstname', $user?->firstname) }}" required>
            @error('firstname')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="phone" class="col-sm-2 col-form-label">Téléphone</label>
        <div class="col-sm-10">
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                id="phone" value="{{ old('phone', $user?->phone) }}" required>
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                id="email" value="{{ old('email', $user?->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
