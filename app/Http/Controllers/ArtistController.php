<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
        return Artist::all();
    }

    public function show($id)
    {
        return Artist::findOrFail($id);
    }

    public function store(Request $request)
    {
        $artist = Artist::create($request->all());
        
        return response()->json($artist, 201);
    }

    public function update(Request $request, $id)
    {
        $artist = Artist::findOrFail($id);
        $artist->update($request->all());
        
        return response()->json($artist);
    }

    public function destroy($id)
    {
        $artist = Artist::findOrFail($id);
        $artist->delete();

        return response()->json(null, 204);
    }
}
