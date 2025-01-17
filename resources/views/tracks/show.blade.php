@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">{{ $track->title }}</h1>

        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <strong>Artist:</strong> 
                <a href="{{ route('artists.show', $track->artist->id) }}">{{ $track->artist->name }}</a>
            </div>
            <div class="col-12 col-md-6">
                <strong>Album:</strong> 
                @if($track->album)
                    <a href="{{ route('albums.show', $track->album->id) }}">{{ $track->album->name }}</a>
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
                <h5 class="mb-3">Listen to the Track:</h5>
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

        <a href="{{ route('tracks.index') }}" class="btn btn-secondary mt-3">Back to Track List</a>
    </div>
@endsection
