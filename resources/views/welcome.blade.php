@include('headers.header')

<div class="p-5 mb-5 text-center text-white"
    style="background-image: url('{{ asset('banner.jpg') }}'); background-size: cover; background-position: center;">
    <div class="container">
        <h1 class="display-4 fw-bold">Bienvenue à l'Agence Immobilière</h1>
        <p class="lead bg-light bg-opacity-25 py-3 rounded fw-bold">Trouvez la maison de vos rêves parmi notre sélection
            exclusive de biens immobiliers.</p>
    </div>
</div>

<div class="container">
    <h2 class="mb-4">Les derniers biens ajoutés :</h2>
    <div class="row">
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
                        <h5 class="card-title text-primary"> <a
                                href="{{ route('biens.show', $bien->id) }}">{{ $bien->title }}</a></h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ number_format($bien->prix, 0, ',', ' ') }} €</h6>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($bien->description, 150) }}</p>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="badge bg-info text-dark">{{ $bien->surface }} m²</span>
                            <span class="badge bg-secondary">{{ $bien->pieces }} Pièces</span>
                        </div>

                        <p class="card-text small text-muted">
                            {{ $bien->address }}<br>
                            {{ $bien->code_postal }} {{ $bien->ville }}
                        </p>
                    </div>
                </div>


            </div>
        @endforeach
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>



@include('headers.footer')