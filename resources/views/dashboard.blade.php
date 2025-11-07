@extends('layout')

@section('title','Tableau de bord')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Mes idées</h1>
        <a href="{{ route('ideas.create') }}" class="btn btn-primary">Nouvelle idée</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @php
        $badgeClass = [
            'Soumise' => 'bg-secondary',
            'En étude' => 'bg-warning text-dark',
            'Validée' => 'bg-success',
            'Rejetée' => 'bg-danger',
        ];
    @endphp

    @if($ideas->isEmpty())
        <p>Aucune idée pour le moment.</p>
    @else
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th style="width:28%">Titre</th>
                        <th style="width:42%">Description</th>
                        <th style="width:12%">Statut</th>
                        <th style="width:18%" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ideas as $idea)
                        <tr>
                            <td class="fw-semibold">{{ $idea->title }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($idea->description, 120) }}</td>
                            <td>
                                @php $class = $badgeClass[$idea->status] ?? 'bg-secondary'; @endphp
                                <span class="badge {{ $class }}">{{ $idea->status }}</span>
                            </td>
                            <td class="text-end">
                                @can('update', $idea)
                                    <a href="{{ route('ideas.edit', $idea) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                                @endcan
                                @can('delete', $idea)
                                    <form action="{{ route('ideas.destroy', $idea) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer cette idée ?')">Supprimer</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $ideas->links() }}
        </div>
    @endif
@endsection
