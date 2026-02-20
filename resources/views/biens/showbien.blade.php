@include('headers.header')

<!-- <main class="flex-shrink-0">

    <div class=" row justify-content-center mt-5">

        <div class="col-md-6 d-flex flex-column justify-content-center mb-5">
            <img src="{{ asset('storage/' . $bien->images) }}" class="rounded mx-auto d-block" alt="{{ $bien->title }}"
                style="width: 100%;height: 100%; width: 900px; height: 1000; object-fit: cover">


        </div>

        <div class="col-md-6 d-flex flex-column ">
            <h1 class="">{{ $bien->title }}</h1>
            <p>{{ $bien->pieces }} pièces - {{ $bien->surface }} m²</p>
            <p class="display-1 fw-bold text-primary">{{ $bien->prix }} € </p>
            <hr class="border-secondary border-1 opacity-25">

            <form action="" class="d-flex">
                <div class="row g-3 mt-4">
                    <h2>Intéressé par ce bien ? Contactez nous !</h2>

                    <div class="col-md-6">
                        <label for="prenom" class="form-label">Prenom</label>
                        <input type="text" class="form-control" id="prenom  " name="prenom" required>
                    </div>




                    <div class="col-md-6">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>


                    <div class="col-md-6">
                        <label for="tem" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" id="tel" name="tel" required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="msg" class="form-label">Message</label>
                        <textarea class="form-control" id="msg" name="msg" rows="3"
                            required>{{ old('description') }}</textarea>
                    </div>



                    <button type="submit" class="btn btn-primary">Nous contacter</button>



                </div>
            </form>
        </div>

        <div class="col-md-6 ">
        </div>

        <div class="col-md-6">
        </div>
    </div>















</main> -->


<main class="">
    <div class="container mt-5">
        <div class="row">

            <div class="col-md-7 mb-4 text-start">
                <img src="{{ asset('storage/' . $bien->images) }}" class="img-fluid rounded" alt="{{ $bien->title }}"
                    style="width: 100%; aspect-ratio: 3/2; object-fit: cover;">

                <blockquote class="blockquote my-2 p-2  bg-light rounded">
                    <p>{{ $bien->description }}</p>
                </blockquote>
                <hr class="my-4 opacity-25">
                <h3 class="fw-bold pt-3">Adresse</h3>
                <ul class="list-group list-group-flush">

                <h3 class="fw-bold pt-3">Caractéristiques</h3>
                <ul class="list-group list-group-flush">

                    <li class="list-group-item bg-light rounded d-flex justify-content-between align-items-center">
                        <span>Surface habitable</span>
                        <span>{{ $bien->surface }} m²</span>
                    </li>
                    <li class="list-group-item d-flex  justify-content-between align-items-center">
                        <span>Pièces</span>
                        <span class=" bg-light rounded-pill">{{ $bien->pieces }}</span>
                    </li>

                    <li class="list-group-item d-flex bg-light rounded justify-content-between align-items-center">
                        <span>Chambres</span>
                        <span>{{ $bien->chambre }}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Etages</span>
                        <span>{{ $bien->etage }}</span>
                    </li>

            </div>

            <div class="col-md-5 ps-md-5">
                <h1 class="h1 mb-4">{{ $bien->title }}</h1>
                <h3 class="text-muted mb-4">{{ $bien->pieces }} pièces - {{ $bien->surface }} m²</h1>
                    <p class="display-4 fw-bold text-primary mb-0">{{ number_format($bien->prix, 0, ',', ' ') }} €</p>

                    <hr class="my-4 opacity-25">

                    <h2 class="h5 mb-3">Intéressé par ce bien ?</h2>

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('biens.contact', $bien) }}" method="POST" class="pb-2">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small">Prénom</label>
                                <input type="text" class="form-control @error('prenom') is-invalid @enderror"
                                    name="prenom" value="{{ old('prenom') }}" required>
                                @error('prenom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Nom</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Téléphone</label>
                                <input type="text" class="form-control @error('tel') is-invalid @enderror" name="tel"
                                    value="{{ old('tel') }}" required>
                                @error('tel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label small">Message</label>
                                <textarea class="form-control @error('msg') is-invalid @enderror" name="msg" rows="3"
                                    required>{{ old('msg') }}</textarea>
                                @error('msg')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 d-grid">
                                <button type="submit" class="btn btn-primary">Nous contacter</button>
                            </div>
                        </div>
                    </form>



                    <h3 class="fw-bold pt-4-">Spécificités</h3>

                    <table class="table">
                        <thead>
                            <tr>
                                @if($bien->options)
                                    @foreach (explode('\n', $bien->options) as $options)
                                        <th scope="col">{{ $options }}</th>
                                    @endforeach
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                    </table>
            </div>






        </div>
    </div>
</main>


@include('headers.footer')
