<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->value();

        $projects = Portofolio::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('admin.projects.index', compact('projects', 'search'));
    }

    public function create(): View
    {
        return view('admin.projects.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['required', 'file', 'image', 'max:4096'],
        ]);

        Portofolio::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'image' => file_get_contents($request->file('image')->getRealPath()),
        ]);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project berhasil ditambahkan.');
    }

    public function edit(Portofolio $project): View
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Portofolio $project): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'file', 'image', 'max:4096'],
        ]);

        $project->title = $validated['title'];
        $project->description = $validated['description'] ?? null;

        if ($request->hasFile('image')) {
            $project->image = file_get_contents($request->file('image')->getRealPath());
        }

        $project->save();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Portofolio $project): RedirectResponse
    {
        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project berhasil dihapus.');
    }
}
