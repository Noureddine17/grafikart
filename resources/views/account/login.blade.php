@include('headers.header')


<body class="bg-light">
  <div class="container">
    <div class="row justify-content-center align-items-center min-vh-100 py-4">
      <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">
        @if (session('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>

        @endif

        <div class="card shadow-sm border-0">

          <div class="card-body p-4 p-md-5">
            <h1 class="h4 mb-1">Connexion</h1>
            <p class="text-muted mb-4">Accède à ton espace.</p>


            <form action="{{ route('users.login') }}" method="post">

              @csrf

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="ex: elias@mail.com"
                  autocomplete="email" required />
              </div>

              <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center">
                  <label for="password" class="form-label mb-0">Mot de passe</label>
                  <a class="small text-decoration-none" href="/forgot-password">Mot de passe oublié ?</a>
                </div>
                <input type="password" class="form-control" id="password" name="password" placeholder="••••••••"
                  autocomplete="current-password" required />
              </div>


              <button type="submit" class="btn btn-primary w-100">
                Se connecter
              </button>

              <div class="text-center mt-4">
                <span class="text-muted">Pas de compte ?</span>
                <a class="text-decoration-none" href="/register">Créer un compte</a>
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