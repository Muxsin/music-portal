<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
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
        $albums = Album::with('artist')->get();
        return view('albums.index', compact('albums'));
    }

    public function create()
    {
        $artists = Artist::all();
        return view('albums.create', compact('artists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'release_year' => 'nullable|integer',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $album = new Album();
        $album->name = $request->name;
        $album->artist_id = $request->artist_id;
        $album->release_year = $request->release_year;
        $album->description = $request->description;

        
        if ($request->has('release_year')) {
            $releaseYear = $request->release_year;
            if ($releaseYear < 1901 || $releaseYear > 2025) {
                return back()->with('error', 'The release year must be between 1901 and 2025.');
            }

            $album->release_year = $releaseYear;
        }

        if ($request->hasFile('cover_image')) {
            $album->cover_image = $request->file('cover_image')->store('album_covers', 'public');
        }

        $album->save();

        return redirect()->route('albums.show', $album->id)->with('success', 'Album added successfully!');
    }

    public function edit(Album $album)
    {
        $artists = Artist::all();
        return view('albums.edit', compact('album', 'artists'));
    }

    public function update(Request $request, Album $album)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'release_year' => 'nullable|integer',
            'artist_id' => 'required|exists:artists,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $album->name = $request->name;
        $album->release_year = $request->release_year;
        $album->artist_id = $request->artist_id;

        if ($request->hasFile('cover_image')) {
            $album->cover_image = $request->file('cover_image')->store('album_covers', 'public');
        }

        $album->save();

        return redirect()->route('albums.index')->with('success', 'Album updated successfully!');
    }

    public function show($id)
    {
        $album = Album::findOrFail($id);
        
        return view('albums.show', compact('album'));
    }

    public function destroy(Album $album)
    {
        $album->delete();

        return redirect()->route('albums.index')->with('success', 'Album deleted successfully!');
    }
}
