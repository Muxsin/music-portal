<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class ArtistController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->isAdmin()) {
                return $next($request);
            }
            abort(403, 'Access denied');
        })->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        $artists = Artist::all();
        
        return view('artists.index', compact('artists'));
    }

    public function create()
    {
        return view('artists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->only(['name', 'description', 'type']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('artists', 'public');
        }

        Artist::create($data);

        return redirect()->route('artists.index');
    }

    public function show(Artist $artist)
    {
        return view('artists.show', compact('artist'));
    }

    public function edit(Artist $artist)
    {
        return view('artists.edit', compact('artist'));
    }

    public function update(Request $request, Artist $artist)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->only(['name', 'description', 'type']);

        if ($request->hasFile('image')) {
            if ($artist->image) {
                Storage::disk('public')->delete($artist->image);
            }

            $data['image'] = $request->file('image')->store('artists', 'public');
        }

        $artist->update($data);

        return redirect()->route('artists.index')->with('success', 'Artist updated successfully!');
    }


    public function destroy(Artist $artist)
    {
        $artist->delete();

        return redirect()->route('artists.index')->with('success', 'Artist deleted successfully!');
    }
}
