@include('headers.header')

@if (!Auth::user() || Auth::user()->role !== 'admin')
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>JAI DIT CASSE TOI !!!</strong> je vais te retrouver et te bannir de ce site si tu continues à essayer
        d'accéder à cette page.
    </div>
@else
    <main>
        <div class="container mt-5">
            <h1>Éditer le bien</h1>
            <form action="{{ route('biens.update', $bien->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-check form-switch">
                    <input type="hidden" name="vendue" value="0" class="form-check-input">
                    <input type="checkbox" name="vendue" value="1" class="form-check-input" {{ $bien->vendue ? 'checked' : '' }}>
                    <label class="form-check-label" for="vendue">Vendu ?</label>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Titre</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $bien->title }}" required>
                </div>


                <div class="mb-3">
                    <label for="surface" class="form-label">Surface (m²)</label>
                    <input type="number" class="form-control" id="surface" name="surface" value="{{ $bien->surface }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="prix" class="form-label">Prix (€)</label>
                    <input type="number" class="form-control" id="prix" name="prix" value="{{ $bien->prix }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"
                        required>{{ $bien->description }}</textarea>
                </div>


                <div class="mb-3">
                    <label for="pieces" class="form-label">Nombre de pièces</label>
                    <input type="number" class="form-control" id="pieces" name="pieces" value="{{ $bien->pieces }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="chambre" class="form-label">Nombre de chambre</label>
                    <input type="number" class="form-control" id="chambre" name="chambre" value="{{ $bien->chambre }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="etage" class="form-label">Etage</label>
                    <input type="number" class="form-control" id="etage" name="etage"
                        placeholder="Laissez vide si pas d'étage" value="{{ $bien->etage }}">
                </div>



                <div class="mb-3">
                    <label for="address" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $bien->address }}"
                        required>
                </div>
                <div class="mb-3">
                    <label for="ville" class="form-label">Ville</label>
                    <input type="text" class="form-control" id="ville" name="ville" value="{{ $bien->ville }}" required>
                </div>
                <div class="mb-3">
                    <label for="code_postal" class="form-label">Code Postal</label>
                    <input type="text" class="form-control" id="code_postal" name="code_postal"
                        value="{{ $bien->code_postal }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Options</label>
                    <div class="d-flex flex-wrap gap-2">
                        @php
                            $selectedOptions = old('options', $bien->featureOptions->pluck('id')->all());
                        @endphp

                        @foreach ($options as $option)
                            <input type="checkbox" class="btn-check" id="edit-option-{{ $option->id }}"
                                name="options[]" value="{{ $option->id }}" autocomplete="off"
                                {{ in_array($option->id, $selectedOptions, true) ? 'checked' : '' }}>
                            <label class="btn btn-outline-primary rounded-pill px-3"
                                for="edit-option-{{ $option->id }}">
                                {{ $option->name }}
                            </label>
                        @endforeach
                    </div>
                    @error('options')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                    @error('options.*')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>
                            

                <div class="mb-3">
                    <label for="images" class="form-label">Image</label>
                    <input type="file" class="form-control" id="images" name="images">
                    @if($bien->images)
                        <img src="{{ asset('storage/' . $bien->images) }}" alt="Image du bien" class="img-thumbnail mt-2"
                            style="max-width: 200px;">
                    @endif
                </div>



                <button type="submit" class="btn btn-primary">Mettre à jour le bien</button>
            </form>
        </div>

    </main>

@endif



@include('headers.footer')
