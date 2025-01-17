<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(Artist $artist)
    {
        $artist_id = $artist->id;

        $alreadyFavorited = auth()->user()->favorites()->where('artist_id', $artist_id)->exists();
        
        if ($alreadyFavorited) {
            return redirect()->route('artists.show', $artist_id)->with('error', 'Artist is already in your favorites!');
        }

        auth()->user()->favorites()->attach($artist_id);

        return redirect()->route('artists.show', $artist_id)->with('success', 'Artist added to favorites!');
    }


    public function destroy(Artist $artist)
    {
        $user = auth()->user();

        $user->favorites()->detach($artist);

        return redirect()->route('artists.show', $artist->id)->with('success', 'Artist removed from favorites!');
    }
}
