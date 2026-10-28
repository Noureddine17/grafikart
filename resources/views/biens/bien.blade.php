@include('headers.header')

@include('sweetalert::alert'),

<main class="">

    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif




        <div class="mt-4">
            <form action="{{ route('biens.index') }}" method="GET" class="mb-4">
                <div class="row g-2 align-items-end">
                    <div class="col-md-3">
                        <label for="surface_min" class="form-label">Surface minimum</label>
                        <input type="text" id="surface_min" name="surface_min" class="form-control"
                            placeholder="Surface minimum" value="{{ request('surface_min') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="pieces_min" class="form-label">Pièces minimum</label>
                        <input type="text" id="pieces_min" name="pieces_min" class="form-control"
                            placeholder="Nombre de pièces min" value="{{ request('pieces_min') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="prix_max" class="form-label">Prix maximum</label>
                        <input type="text" id="prix_max" name="prix_max" class="form-control"
                            placeholder="Prix maximum" value="{{ request('prix_max') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="mots_clef" class="form-label">Mot-clé</label>
                        <input type="text" id="mots_clef" name="mots-clef" class="form-control"
                            placeholder="Mot-clé" value="{{ request('mots-clef') }}">
                    </div>
                </div>

                <div class="mt-3">
                    <span class="d-block fw-semibold mb-2">Options</span>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($options as $option)
                            <input type="checkbox" class="btn-check" id="option-{{ $option->id }}" name="options[]"
                                value="{{ $option->id }}" autocomplete="off"
                                {{ in_array($option->id, $selectedOptions ?? [], true) ? 'checked' : '' }}>
                            <label class="btn btn-outline-primary rounded-pill px-3"
                                for="option-{{ $option->id }}">
                                {{ $option->name }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                    <a href="{{ route('biens.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
                </div>
            </form>
        </div>
        
        <div class="row">
            <h1>Liste des biens</h1>
            
            @foreach ($biens as $bien)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if(!empty($bien->images))
                            <img src="{{ asset('storage/' . $bien->images) }}" class="card-img-top" alt="{{ $bien->title }}"
                                style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                                style="height: 200px;">
                                Pas d'image
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-primary"> <a href="/biens/{{ $bien->id }}"> {{ $bien->title }} </a></h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ number_format($bien->prix, 0, ',', ' ') }} €</h6>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($bien->description, 244) }}</p>

                            <div class="d-flex justify-content-between mb-3">
                                <span class="badge bg-info text-dark">{{ $bien->surface }} m²</span>
                                <span class="badge bg-secondary">{{ $bien->pieces }} Pièces</span>
                            </div>

                            @if ($bien->featureOptions->isNotEmpty())
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    @foreach ($bien->featureOptions as $option)
                                        <span class="badge rounded-pill text-bg-light border">{{ $option->name }}</span>
                                    @endforeach
                                </div>
                            @endif

                            <p class="card-text small text-muted">
                                {{ $bien->address }}<br>
                                {{ $bien->code_postal }} {{ $bien->ville }}
                            </p>
                            @if ( Auth::user() && Auth::user()->role === 'admin')
                                <a href="{{ route('biens.edit', $bien->id) }}" class="btn btn-sm btn-outline-primary">Éditer</a>

                                
                                <a href="{{ route('biens.destroy', $bien->id) }}"
                                    data-confirm-delete="true"
                                    class="btn btn-sm btn-outline-danger">
                                    Supprimer
                                </a>

                                

                     
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        
   

<div class="mt-4 ">
    {{ $biens->links() }}
</div>
        
    </div>


</main>













@include('headers.footer')
