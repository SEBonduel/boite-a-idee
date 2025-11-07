@extends('layout')

@section('title', 'Connexion')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <h1 class="mb-4">Connexion</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ route('login.perform') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Se connecter</button>
            </form>
            <p class="mt-3 text-center">
                Pas de compte ?
                <a href="{{ route('register.show') }}">Créer un compte</a>
            </p>
        </div>
    </div>
@endsection
