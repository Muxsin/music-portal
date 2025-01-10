<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        return Favorite::all();
    }

    public function show($id)
    {
        return Favorite::findOrFail($id);
    }

    public function store(Request $request)
    {
        $favorite = Favorite::create($request->all());
        
        return response()->json($favorite, 201);
    }

    public function destroy($id)
    {
        $favorite = Favorite::findOrFail($id);
        $favorite->delete();

        return response()->json(null, 204);
    }
}
