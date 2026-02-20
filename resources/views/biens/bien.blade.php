@include('headers.header')



<main class="">

    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif




        <div class="mt-4">
            <form action="{{ route('biens.index') }}" method="GET" class="d-flex mb-4">
                @csrf
                <input type="text" name="surface_min" class="form-control " placeholder="Surface minimum" aria-label="Surface minimum" value="{{ old('surface_min') }}">
                <input type="text" name="pieces_min" class="form-control ms-2" placeholder="Nombre de pièces min" aria-label="Pieces minimum" value="{{ old('pieces_min') }}">
                <input type="text" name="prix_max" class="form-control ms-2" placeholder="Prix maximum" aria-label="Prix maximum" value="{{ old('prix_max') }}">
                <input type="text" name="mots-clef" class="form form-control ms-2" placeholder="Mot Clef" aria-label="mots clef" value="{{ old('mots-clef') }}">


                <button type="submit" class="btn btn-primary ms-2">Rechercher</button>
                
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

                            <p class="card-text small text-muted">
                                {{ $bien->address }}<br>
                                {{ $bien->code_postal }} {{ $bien->ville }}
                            </p>
                            @if ( Auth::user() && Auth::user()->role === 'admin')
                                <a href="{{ route('biens.edit', $bien->id) }}" class="btn btn-sm btn-outline-primary">Éditer</a>

                                <form action="{{ route('biens.destroy', $bien->id) }}" method="POST" class="btn-group">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
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