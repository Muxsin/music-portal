<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class TrackController extends Controller
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
        $tracks = Track::with(['artist', 'album'])->get();
        
        return view('tracks.index', compact('tracks'));
    }

    public function create()
    {
        $albums = Album::all();
        $artists = Artist::all();

        return view('tracks.create', compact('albums', 'artists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'nullable|string|max:100',
            'duration' => 'nullable|integer',
            'release_year' => 'nullable|integer',
            'album_id' => 'nullable|exists:albums,id',
            'artist_id' => 'required|exists:artists,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'file_path' => 'nullable|file|mimes:mp3,wav,flac|max:10240',  // Максимум 10MB
        ]);

        $track = new Track();
        $track->title = $request->title;
        $track->genre = $request->genre;
        $track->duration = $request->duration;
        $track->release_year = $request->release_year;
        $track->album_id = $request->album_id;
        $track->artist_id = $request->artist_id;

        if ($request->hasFile('image')) {
            $track->image = $request->file('image')->store('track_images', 'public');
        }

        if ($request->hasFile('file_path')) {
            $track->file_path = $request->file('file_path')->store('tracks', 'public');
        }

        $track->save();

        return redirect()->route('tracks.show', $track->id)->with('success', 'Track added successfully!');
    }

    public function show(Track $track)
    {
        return view('tracks.show', compact('track'));
    }

    public function edit(Track $track)
    {
        $albums = Album::all();
        $artists = Artist::all();

        return view('tracks.edit', compact('track', 'albums', 'artists'));
    }

    public function update(Request $request, Track $track)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'nullable|string|max:100',
            'duration' => 'nullable|integer',
            'release_year' => 'nullable|integer',
            'album_id' => 'nullable|exists:albums,id',
            'artist_id' => 'required|exists:artists,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'file_path' => 'nullable|file|mimes:mp3,wav,flac|max:10240',  // Максимум 10MB
        ]);

        $track->title = $request->title;
        $track->genre = $request->genre;
        $track->duration = $request->duration;
        $track->release_year = $request->release_year;
        $track->album_id = $request->album_id;
        $track->artist_id = $request->artist_id;

        if ($request->hasFile('image')) {
            $track->image = $request->file('image')->store('track_images', 'public');
        }

        if ($request->hasFile('file_path')) {
            $track->file_path = $request->file('file_path')->store('tracks', 'public');
        }

        $track->save();

        return redirect()->route('tracks.show', $track->id)->with('success', 'Track updated successfully!');
    }

    public function destroy(Track $track)
    {
        $track->delete();

        return redirect()->route('tracks.index')->with('success', 'Track deleted successfully!');
    }
}
