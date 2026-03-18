@include('headers.header')

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100 py-4">
            <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
                        <h1 class="h4 mb-1">Réinitialiser le mot de passe</h1>
                        <p class="text-muted mb-4">Choisissez un nouveau mot de passe pour votre compte.</p>

                        <form action="{{ route('ResetPassword') }}" method="post">
                            @csrf

                            <input type="hidden" name="token" value="{{ request('token') }}">
                            <input type="hidden" name="email" value="{{ request('email') }}">

                            <div class="mb-3">
                                <label for="password" class="form-label">Nouveau mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    autocomplete="new-password" required>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" autocomplete="new-password" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Réinitialiser le mot de passe
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
