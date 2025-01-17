@extends('layouts.app')

@section('content')
    <h1>Create New Album</h1>

    <form action="{{ route('albums.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Album Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>

        <div class="mb-3">
            <label for="artist_id" class="form-label">Artist</label>
            <select name="artist_id" class="form-select" id="artist_id" required>
                @foreach($artists as $artist)
                    <option value="{{ $artist->id }}">{{ ucwords($artist->name) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="release_year" class="form-label">Release Year</label>
            <input type="number" name="release_year" class="form-control" id="release_year">
        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">Cover Image</label>
            <input type="file" name="cover_image" class="form-control" id="cover_image">
        </div>

        <button type="submit" class="btn btn-primary">Create Album</button>
        <a href="{{ route('albums.index') }}" class="btn btn-secondary ms-2">Back to List</a>
    </form>
@endsection
