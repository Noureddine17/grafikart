@include('headers.header')

<main class="py-5">
    <div class="container" style="max-width: 720px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">✏️ Modifier une option</h1>
                <p class="text-muted mb-0">Mets a jour le nom de l'option selectionnee.</p>
            </div>
            <a href="{{ route('options.index') }}" class="btn btn-outline-secondary">Retour</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger shadow-sm" role="alert">
                <strong>Le formulaire contient des erreurs.</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('options.update', $option) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom de l'option</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name', $option->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Mettre a jour</button>
                        <a href="{{ route('options.index') }}" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@include('headers.footer')
