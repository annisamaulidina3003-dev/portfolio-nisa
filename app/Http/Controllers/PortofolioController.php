<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    public function index()
    {
        $portofolios = Portofolio::all();

        return view('index', compact('portofolios'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|file|image|max:2048',
        ]);

        $imageData = file_get_contents($request->file('image')->getRealPath());

        Portofolio::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'image' => $imageData,
        ]);

        return redirect()->back()->with('success', 'Project berhasil ditambahkan!');
    }

    public function edit(Portofolio $portofolio)
    {
        return view('edit', compact('portofolio'));
    }

    public function update(Request $request, Portofolio $portofolio)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|file|image|max:2048',
        ]);

        $portofolio->title = $validated['title'];
        $portofolio->description = $validated['description'] ?? null;

        if ($request->hasFile('image')) {
            $imageData = file_get_contents($request->file('image')->getRealPath());
            $portofolio->image = $imageData;
        }

        $portofolio->save();

        return redirect('/')->with('success', 'Project berhasil diperbarui!');
    }

    public function destroy(Portofolio $portofolio)
    {
        $portofolio->delete();

        return redirect('/')->with('success', 'Project berhasil dihapus!');
    }
}


