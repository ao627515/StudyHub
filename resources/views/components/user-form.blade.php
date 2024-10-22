<div class="row mb-3">
    <div class="col-sm-6">
        <label for="lastname" class="col-form-label">Nom</label>
        <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" id="lastname"
            value="{{ old('lastname', $user?->lastname) }}" required>
        @error('lastname')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-6">
        <label for="firstname" class="col-form-label">Prénom</label>
        <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror"
            id="firstname" value="{{ old('firstname', $user?->firstname) }}" required>
        @error('firstname')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <div class="col-sm-6">
        <label for="phone" class="col-form-label">Téléphone</label>
        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone"
            value="{{ old('phone', $user?->phone) }}" required>
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-6">
        <label for="email" class="col-form-label">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
            value="{{ old('email', $user?->email) }}" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
