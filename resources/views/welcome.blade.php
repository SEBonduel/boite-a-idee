@extends('layout')

@section('title', 'Bienvenue')

@section('content')
    <div class="text-center">
        <h1 class="mb-4">Bienvenue dans la Boîte à Idées</h1>
        <p class="mb-4">Propose tes idées d’amélioration et fais évoluer l’entreprise.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ url('/connexion') }}" class="btn btn-primary btn-lg">Connexion</a>
            <a href="{{ url('/inscription') }}" class="btn btn-outline-primary btn-lg">S'inscrire</a>
        </div>
    </div>
@endsection
