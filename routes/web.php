<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\TrackLikeController;
use App\Http\Controllers\ListeningHistoryController;
use App\Http\Controllers\DownloadHistoryController;
use App\Models\Track;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $tracks = Track::with(['artist', 'album'])->get();
        
    return view('tracks.index', compact('tracks'));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        $favoriteTracks = $user->tracks()->with('artist')->get();

        $favoriteArtists = $user->favorites()->get();
        
        return view('dashboard', compact('favoriteTracks', 'favoriteArtists'));
    })->name('dashboard');
});


Route::middleware('auth')->group(function () {
    Route::post('tracks/{track}/like', [TrackController::class, 'like'])->name('tracks.like');
    Route::post('tracks/{track}/unlike', [TrackController::class, 'unlike'])->name('tracks.unlike');
});

Route::resource('artists', ArtistController::class);
Route::resource('tracks', TrackController::class);

Route::post('/favorites/{artist}', [FavoriteController::class, 'store'])->name('favorites.store');
Route::delete('/favorites/{artist}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

Route::resource('albums', AlbumController::class);
Route::resource('tracks', TrackController::class);
Route::resource('track-likes', TrackLikeController::class);
Route::resource('listening-history', ListeningHistoryController::class);
Route::resource('download-history', DownloadHistoryController::class);