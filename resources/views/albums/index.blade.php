@extends('layouts.app')

@section('content')
    <h1>Albums</h1>

    @if(auth()->user() && auth()->user()->isAdmin())
        <a href="{{ route('albums.create') }}" class="btn btn-primary mb-3">Create New Album</a>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Artist</th>
                <th>Release Year</th>
                <th>Cover Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($albums as $album)
                <tr>
                    <td>{{ ucwords($album->name) }}</td>
                    <td>{{ $album->artist->name }}</td>
                    <td>{{ $album->release_year ?? 'Not Specified' }}</td>
                    <td>
                        <img 
                            src="{{ $album->cover_image ? asset('storage/' . $album->cover_image) : asset('images/track-default.avif') }}"
                            class="img-thumbnail shadow" style="width: 100px; height: 100px; object-fit: cover; margin-right: 15px;">
                    </td>
                    <td>
                        <a href="{{ route('albums.show', $album->id) }}" class="btn btn-info btn-sm">View</a>

                        @if(auth()->user() && auth()->user()->isAdmin())
                            <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('albums.destroy', $album->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
