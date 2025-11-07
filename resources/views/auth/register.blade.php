@extends('layout')

@section('title', 'Inscription')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <h1 class="mb-4">Créer un compte</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ route('register.perform') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">S’inscrire</button>
            </form>
            <p class="mt-3 text-center">
                Déjà un compte ?
                <a href="{{ route('login.show') }}">Se connecter</a>
            </p>
        </div>
    </div>
@endsection
