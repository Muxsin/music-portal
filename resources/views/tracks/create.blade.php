@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Add New Track</h1>

        <form action="{{ route('tracks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Track Title</label>
                <input type="text" class="form-control" name="title" id="title" required>
            </div>

            <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <input type="text" class="form-control" name="genre" id="genre">
            </div>

            <div class="mb-3">
                <label for="duration" class="form-label">Duration (seconds)</label>
                <input type="number" class="form-control" name="duration" id="duration">
            </div>

            <div class="mb-3">
                <label for="release_year" class="form-label">Release Year</label>
                <input type="number" class="form-control" name="release_year" id="release_year">
            </div>

            <div class="mb-3">
                <label for="album_id" class="form-label">Album</label>
                <select name="album_id" id="album_id" class="form-select">
                    <option value="">Select Album</option>
                    @foreach ($albums as $album)
                        <option value="{{ $album->id }}">{{ $album->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="artist_id" class="form-label">Artist</label>
                <select name="artist_id" id="artist_id" class="form-select" required>
                    <option value="">Select Artist</option>
                    @foreach ($artists as $artist)
                        <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="file_path" class="form-label">Upload Track File</label>
                <input type="file" class="form-control" name="file_path" id="file_path" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Track Image</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>

            <button type="submit" class="btn btn-primary">Add Track</button>
            <a href="{{ route('tracks.index') }}" class="btn btn-secondary">Back to Track List</a>
        </form>
    </div>
@endsection
