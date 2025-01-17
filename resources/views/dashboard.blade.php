@extends('layouts.app')

@section('content')
  <h1>Dashboard</h1>

  <div class="mb-4">
    <h3>Your Favorite Tracks</h3>
    @if ($favoriteTracks->count() > 0)
      <ul class="list-group">
        @foreach ($favoriteTracks as $track)
          @if ($track)
            <li class="list-group-item">
            <img 
                    src="{{ $track->image ? asset('storage/' . $track->image) : asset('images/track-default.avif') }}"
                    class="img-thumbnail shadow" style="width: 100px; height: 100px; object-fit: cover; margin-right: 15px;">
              <a href="{{ route('tracks.show', $track->id) }}">
                <strong>{{ ucwords($track->title) }}</strong>
              </a>
            </li>
          @else
            <li class="list-group-item">No track found</li>
          @endif
        @endforeach
      </ul>
    @else
      <p>No favorite tracks yet.</p>
    @endif
  </div>

  <div class="mb-4">
    <h3>Your Favorite Artists</h3>
    @if ($favoriteArtists->count() > 0)
      <ul class="list-group">
        @foreach ($favoriteArtists as $artist)
          @if ($artist)
            <li class="list-group-item">
                <img 
                    src="{{ $artist->image ? asset('storage/' . $artist->image) : asset('images/track-default.avif') }}"
                    class="img-thumbnail shadow" style="width: 100px; height: 100px; object-fit: cover; margin-right: 15px;">
              <a href="{{ route('artists.show', $artist->id) }}">
                <strong>{{ ucwords($artist->name) }}</strong>
              </a>
            </li>
          @else
            <li class="list-group-item">No artist found</li>
          @endif
        @endforeach
      </ul>
    @else
      <p>No favorite artists yet.</p>
    @endif
  </div>
@endsection