@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">{{ ucwords($album->name) }}</h1>

        <div class="row">
            <div class="col-md-4">
                <img 
                    src="{{ $album->cover_image ? asset('storage/' . $album->cover_image) : asset('images/track-default.avif') }}"
                    class="img-thumbnail shadow" style="width: 250px; height: 250px; object-fit: cover; margin-right: 15px;">
            </div>

            <div class="col-md-8">
                <p><strong>Artist:</strong> {{ $album->artist->name }}</p>
                <p><strong>Release Year:</strong> {{ $album->release_year ?? 'Not Specified' }}</p>
                <p><strong>Description:</strong> {{ $album->description ?? 'No description available.' }}</p>
            </div>
        </div>

        <h3 class="mt-4">Tracks:</h3>
        @if($album->tracks->count() > 0)
            <div class="list-group">
                @foreach($album->tracks as $track)
                    <div class="list-group-item">
                        <a href="{{ route('tracks.show', $track->id) }}" class="h5">{{ ucwords($track->title) }}</a>
                        <br>
                        @if($track->file_path)
                            <audio controls class="w-100 mt-2">
                                <source src="{{ asset('storage/' . $track->file_path) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        @else
                            <p class="mt-2 text-muted">No audio file available for this track.</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p>No tracks available for this album.</p>
        @endif

        <div class="mt-4">
            <a href="{{ route('albums.index') }}" class="btn btn-secondary">Back to Albums</a>
        </div>
    </div>
@endsection
