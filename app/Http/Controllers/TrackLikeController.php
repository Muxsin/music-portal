<?php

namespace App\Http\Controllers;

use App\Models\TrackLike;
use Illuminate\Http\Request;

class TrackLikeController extends Controller
{
    public function index()
    {
        return TrackLike::all();
    }

    public function show($id)
    {
        return TrackLike::findOrFail($id);
    }

    public function store(Request $request)
    {
        $like = TrackLike::create($request->all());
        
        return response()->json($like, 201);
    }

    public function destroy($id)
    {
        $like = TrackLike::findOrFail($id);
        $like->delete();

        return response()->json(null, 204);
    }
}
