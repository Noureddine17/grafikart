@include('headers.header')

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100 py-4">
            <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">
                
                {{-- Gestion des messages de succès ou d'erreur --}}
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @error('email')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
                        <h1 class="h4 mb-1">Mot de passe oublié ?</h1>
                        <p class="text-muted mb-4">Entrez votre email pour recevoir un lien de réinitialisation.</p>

                        {{-- route d'action --}}
                        <form action="{{ route('ForgotPassword') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="ex: elias@mail.com" autocomplete="email" required value="{{ old('email') }}" />
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Envoyer le lien
                            </button>

                            <div class="text-center mt-4">
                                <a class="text-decoration-none small" href="{{ route('login') }}">
                                    <i class="bi bi-arrow-left"></i> Retour à la connexion
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <p class="text-center text-muted small mt-3 mb-0">
                    © <span id="y"></span> Chez nono
                </p>
            </div>
        </div>
    </div>

@include('headers.footer')