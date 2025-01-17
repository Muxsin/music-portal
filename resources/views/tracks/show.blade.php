@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="media d-flex">
            @if($track->image)
                <img src="{{ asset('storage/' . $track->image) }}" alt="{{ $track->title }}" class="align-self-start rounded d-block mr-3 img-thumbnail shadow" width="250">
            @else
                <img src="{{ asset('images/track-default.avif') }}" alt="Default Image" class="align-self-start rounded d-block mr-3 img-thumbnail shadow" width="250">
            @endif
            
            <div class="media-body mx-4">
                <h1 class="mt-0">{{ ucwords($track->title) }}</h1>

                @if (Auth::check())
                    @if ($track->isLikedByUser())
                        <form action="{{ route('tracks.unlike', $track->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Unlike</button>
                        </form>
                    @else
                        <form action="{{ route('tracks.like', $track->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Like</button>
                        </form>
                    @endif
                @endif

                <div class="mt-3">
                    <strong>Likes:</strong> {{ $track->likes->count() }}
                </div>
                
                <div class="row mb-3">
                    <div class="col-12 col-md-6">
                        <strong>Artist:</strong> 
                        <a href="{{ route('artists.show', $track->artist->id) }}">{{ ucwords($track->artist->name) }}</a>
                    </div>
                    <div class="col-12 col-md-6">
                        <strong>Album:</strong> 
                        @if($track->album)
                            <a href="{{ route('albums.show', $track->album->id) }}">{{ ucwords($track->album->name) }}</a>
                        @else
                            No Album
                        @endif
                    </div>
                    <div class="col-12 col-md-6">
                        <strong>Genre:</strong> {{ $track->genre ?? 'Not Specified' }}
                    </div>
                    <div class="col-12 col-md-6">
                        <strong>Duration:</strong> 
                        {{ $track->duration ? gmdate('i:s', $track->duration) : 'Not Specified' }}
                    </div>
                    <div class="col-12 col-md-6">
                        <strong>Release Year:</strong> {{ $track->release_year ?? 'Not Specified' }}
                    </div>
                </div>

                @if($track->file_path)
                    <div class="mb-3">
                        <audio controls class="w-100">
                            <source src="{{ asset('storage/' . $track->file_path) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                @else
                    <div class="alert alert-danger">
                        No audio file available for this track.
                    </div>
                @endif
            </div>
        </div>

        <a href="{{ route('tracks.index') }}" class="btn btn-secondary mt-3">Back to Track List</a>
    </div>
@endsection
