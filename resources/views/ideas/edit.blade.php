@extends('layout')

@section('title', 'Modifier une idée')

@section('content')
    <h1 class="mb-4">Modifier une idée</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('ideas.update', $idea) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="title" value="{{ old('title', $idea->title) }}" class="form-control" required
                maxlength="180">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="6" class="form-control" required>{{ old('description', $idea->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Statut</label>
            <select name="status" class="form-select">
                <option value="Soumise" selected>Soumise</option>
                <option value="En étude">En étude</option>
                <option value="Validée">Validée</option>
                <option value="Rejetée">Rejetée</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Annuler</a>
    </form>
@endsection
