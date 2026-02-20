@include('headers.header')

<main class="py-5">
    <div class="container" style="max-width: 980px;">
        <div class="mb-4">
            <h1 class="mb-1">Ajouter un bien</h1>
            <p class="text-muted mb-0">Renseigne les informations principales du bien immobilier.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Le formulaire contient des erreurs.</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('biens.store') }}" method="POST" enctype="multipart/form-data" class="card shadow-sm border-0">
            @csrf

            <div class="card-body p-4 p-md-5">
                <h2 class="h5 mb-3">Informations generales</h2>
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <label for="title" class="form-label">Titre du bien</label>
                        <input type="text" id="title" name="title"
                            class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="surface" class="form-label">Surface (m²)</label>
                        <input type="number" id="surface" name="surface"
                            class="form-control @error('surface') is-invalid @enderror" value="{{ old('surface') }}" min="0"
                            required>
                        @error('surface')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="pieces" class="form-label">Nombre de pieces</label>
                        <input type="number" id="pieces" name="pieces"
                            class="form-control @error('pieces') is-invalid @enderror" value="{{ old('pieces') }}" min="1"
                            required>
                        @error('pieces')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="chambre" class="form-label">Nombre de chambres</label>
                        <input type="number" id="chambre" name="chambre"
                            class="form-control @error('chambre') is-invalid @enderror" value="{{ old('chambre') }}"
                            min="0">
                        @error('chambre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="prix" class="form-label">Prix (€)</label>
                        <input type="number" id="prix" name="prix"
                            class="form-control @error('prix') is-invalid @enderror" value="{{ old('prix') }}" min="0"
                            required>
                        @error('prix')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="etage" class="form-label">Etage</label>
                        <input type="number" id="etage" name="etage"
                            class="form-control @error('etage') is-invalid @enderror" value="{{ old('etage') }}"
                            placeholder="Laisser vide si non applicable">
                        @error('etage')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" rows="5" class="form-control @error('description') is-invalid @enderror"
                            required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <h2 class="h5 mb-3">Localisation et details</h2>
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <label for="address" class="form-label">Adresse</label>
                        <input type="text" id="address" name="address"
                            class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}"
                            required>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="ville" class="form-label">Ville</label>
                        <input type="text" id="ville" name="ville"
                            class="form-control @error('ville') is-invalid @enderror" value="{{ old('ville') }}" required>
                        @error('ville')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="code_postal" class="form-label">Code postal</label>
                        <input type="text" id="code_postal" name="code_postal"
                            class="form-control @error('code_postal') is-invalid @enderror" value="{{ old('code_postal') }}"
                            required>
                        @error('code_postal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="options" class="form-label">Options</label>
                        <input type="text" id="options" name="options"
                            class="form-control @error('options') is-invalid @enderror" value="{{ old('options') }}"
                            placeholder="Ex: balcon, garage, jardin">
                        @error('options')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="images" class="form-label">Image principale</label>
                        <input type="file" id="images" name="images"
                            class="form-control @error('images') is-invalid @enderror" accept="image/*" required>
                        @error('images')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">Enregistrer le bien</button>
                    <a href="{{ route('biens.index') }}" class="btn btn-outline-secondary">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</main>

@include('headers.footer')
