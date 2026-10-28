@include('headers.header')

<main class="py-5">
    <div class="container" style="max-width: 960px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">Gestion des options</h1>
                <p class="text-muted mb-0">Ajoute et consulte les options disponibles pour tes biens.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

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

        <div class="row g-4">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h2 class="h5 mb-3">Ajouter une option</h2>

                        <form action="{{ route('options.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom de l'option</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" required
                                    placeholder="Ex: Balcon, Garage, Terrasse ">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Ajouter l'option</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2 class="h5 mb-0">Liste des options</h2>
                            <span class="text-muted small">Tableau des options en base</span>
                        </div>

                        @if ($options->isEmpty())
                            <div class="alert alert-light border mb-0">Aucune option enregistrée pour le moment.</div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" style="width: 90px;">ID</th>
                                            <th scope="col">Nom</th>
                                            <th scope="col" class="text-end" style="width: 180px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($options as $option)
                                            <tr>
                                                <td><span>{{ $option->id}} -</span></td>
                                                <td class="fw-medium">{{ $option->name }}</td>
                                                <td class="text-end">
                                                    <div class="d-inline-flex gap-2">
                                                        <a href="{{ route('options.edit', $option) }}"
                                                            class="btn btn-sm btn-secondary">
                                                            ✏️
                                                        </a>
                                                        <a href="{{ route('options.destroy', $option) }}"
                                                            data-confirm-delete="true"
                                                            class="btn btn-sm btn-danger">
                                                            X
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('headers.footer')
