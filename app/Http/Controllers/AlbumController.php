<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        return Album::all();
    }

    public function show($id)
    {
        return Album::findOrFail($id);
    }

    public function store(Request $request)
    {
        $album = Album::create($request->all());
       
        return response()->json($album, 201);
    }

    public function update(Request $request, $id)
    {
        $album = Album::findOrFail($id);
        $album->update($request->all());
       
        return response()->json($album);
    }

    public function destroy($id)
    {
        $album = Album::findOrFail($id);
        $album->delete();
       
        return response()->json(null, 204);
    }
}
