@extends('layouts.authentification')

@section('content')

    <main>
        <div class="container d-flex min-vh-100 align-items-center justify-content-center">
            <section class="section register py-4 w-100 mt-5" style="max-width: 420px;">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-center py-4">
                            <a href="{{ url('/') }}" class="logo d-flex align-items-center w-auto">
                                <img src="image/prea.png" alt="Logo" class="img-circle">
                            </a>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger mb-4">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST"
                            class=" form-horizontal form-material row g-3 needs-validation" novalidate>
                            @csrf
                            <div class="col-12 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group has-validation">
                                    <input type="text" name="email"
                                        class="form-control form-control-line @error('email') is-invalid @enderror"
                                        id="email" value="{{ old('email') }}" required autofocus>
                                    @error('email')
                                        <div class="invalid-feedback mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <div class="input-group">
                                    <input type="password" name="password"
                                        class="form-control form-control-line @error('password') is-invalid @enderror"
                                        id="password" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-white border-0" id="togglePassword"
                                            style="cursor: pointer;">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" value="true"
                                        id="rememberMe" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="rememberMe">Se souvenir de moi</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="btn waves-effect waves-light btn-rounded btn-primary w-100" type="submit">Se
                                    connecter</button>
                            </div>
                            <div class="col-12 mt-3">
                                <p class="small mb-0">Vous n'avez pas de compte ? <a href="{{ route('register') }}">Créer un
                                        compte</a></p>
                            </div>
                        </form>
                    </div>
                </div>

                <div class=" text-center credits mt-3">
                    Conçu par <br> <a href="https://prea.gov.mg/">Programme de Réformes pour l'Efficacité de
                        l'Administration</a>
                </div>
            </section>
        </div>
    </main>



    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const icon = this.querySelector('i');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
@endsection
