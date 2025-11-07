<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();
        $status = $request->string('status')->toString();

        $ideas = Idea::where('user_id', Auth::id())
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('title', 'like', "%{$q}%")->orWhere('description', 'like', "%{$q}%");
                });
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('dashboard', [
            'ideas' => $ideas,
            'q' => $q,
            'status' => $status,
        ]);
    }

    public function create()
    {
        return view('ideas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'description' => ['required', 'string'],
            'status' => ['nullable', 'string', 'in:Soumise,En étude,Validée,Rejetée'],
        ]);

        Idea::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'] ?? 'Soumise',
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Idée créée avec succès.');
    }

    public function edit(Idea $idea)
    {
        $this->authorize('update', $idea);
        return view('ideas.edit', compact('idea'));
    }

    public function update(Request $request, Idea $idea)
    {
        $this->authorize('update', $idea);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'description' => ['required', 'string'],
            'status' => ['required', 'string', 'in:Soumise,En étude,Validée,Rejetée'],
        ]);

        $idea->update($data);

        return redirect()->route('dashboard')->with('success', 'Idée mise à jour.');
    }

    public function destroy(Idea $idea)
    {
        $this->authorize('delete', $idea);

        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'Idée supprimée.');
    }
}
