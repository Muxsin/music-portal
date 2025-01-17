@extends('layouts.app')

@section('content')
    <div class="container my-4">
        <h1>Edit Track</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('tracks.update', $track->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Track Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $track->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <input type="text" class="form-control" id="genre" name="genre" value="{{ old('genre', $track->genre) }}">
            </div>

            <div class="mb-3">
                <label for="duration" class="form-label">Duration (in seconds)</label>
                <input type="number" class="form-control" id="duration" name="duration" value="{{ old('duration', $track->duration) }}">
            </div>

            <div class="mb-3">
                <label for="release_year" class="form-label">Release Year</label>
                <input type="number" class="form-control" id="release_year" name="release_year" value="{{ old('release_year', $track->release_year) }}">
            </div>

            <div class="mb-3">
                <label for="album_id" class="form-label">Album</label>
                <select class="form-select" id="album_id" name="album_id">
                    <option value="">No Album</option>
                    @foreach ($albums as $album)
                        <option value="{{ $album->id }}" {{ $track->album_id == $album->id ? 'selected' : '' }}>{{ $album->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="artist_id" class="form-label">Artist</label>
                <select class="form-select" id="artist_id" name="artist_id" required>
                    @foreach ($artists as $artist)
                        <option value="{{ $artist->id }}" {{ $track->artist_id == $artist->id ? 'selected' : '' }}>{{ $artist->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Track Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            @if($track->image)
                <img src="{{ asset('storage/' . $track->image) }}" alt="{{ $track->title }}" class="align-self-start rounded d-block mr-3 img-thumbnail shadow" width="250">
            @else
                <img src="{{ asset('images/track-default.avif') }}" alt="Default Image" class="align-self-start rounded d-block mr-3 img-thumbnail shadow" width="250">
            @endif

            <div class="mb-3">
                <label for="file_path" class="form-label">Track File</label>
                <input type="file" class="form-control" id="file_path" name="file_path">
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


            <button type="submit" class="btn btn-primary">Update Track</button>
            <a href="{{ route('tracks.index') }}" class="btn btn-secondary">Back to Track List</a>
        </form>
    </div>
@endsection
