<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function index()
    {
        return Track::all();
    }

    public function show($id)
    {
        return Track::findOrFail($id);
    }

    public function store(Request $request)
    {
        $track = Track::create($request->all());
        
        return response()->json($track, 201);
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
