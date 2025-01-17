<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Track;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function index()
    {
        return Track::all();
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
            // 'file_path' => 'nullable|file|mimes:mp3,wav,flac|max:10240',  // Максимум 10MB
        ]);

        $track = new Track();
        $track->title = $request->title;
        $track->genre = $request->genre;
        $track->duration = $request->duration;
        $track->release_year = $request->release_year;
        $track->album_id = $request->album_id;
        $track->artist_id = $request->artist_id;

        // Загрузка файла
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

    public function update(Request $request, $id)
    {
        $track = Track::findOrFail($id);
        $track->update($request->all());
        
        return response()->json($track);
    }

    public function destroy($id)
    {
        $track = Track::findOrFail($id);
        $track->delete();
        
        return response()->json(null, 204);
    }
}
