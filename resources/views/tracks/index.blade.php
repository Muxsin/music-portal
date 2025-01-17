@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Tracks List</h1>

        @if(auth()->user() && auth()->user()->isAdmin())
            <a href="{{ route('tracks.create') }}" class="btn btn-success mb-3">Create track</a>
        @endif

        @if ($tracks->isEmpty())
            <p>No tracks available.</p>
        @else
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach ($tracks as $track)
                    <div class="col">
                        <div class="d-flex justify-content-between align-items-center border p-3 rounded">
                            <div class="d-flex align-items-center">
                                <img src="{{ $track->image ? asset('storage/' . $track->image) : asset('images/track-default.avif') }}" 
                                     alt="{{ $track->title }}" 
                                     class="img-thumbnail shadow" 
                                     style="width: 150px; height: 150px; object-fit: cover;">

                                <div class="ms-3">
                                    <h5 class="mb-1">{{ ucwords($track->title) }}</h5>
                                    <p class="mb-0">
                                        <strong>Artist:</strong> 
                                        <a href="{{ route('artists.show', $track->artist_id) }}">
                                            {{ ucwords($track->artist->name) }}
                                        </a><br>
                                        <strong>Album:</strong> 
                                        @if ($track->album)
                                            <a href="{{ route('albums.show', $track->album_id) }}">
                                                {{ ucwords($track->album->name) }}
                                            </a>
                                        @else
                                            No Album
                                        @endif
                                    </p>
                                    <div class="mt-3">
                                        <strong>Likes:</strong> {{ $track->likes->count() }}
                                    </div>
                                </div>
                            </div>

                            <div class="text-end">
                                <span>
                                    <a href="{{ route('tracks.show', $track->id) }}" class="btn btn-primary btn-sm">View</a>
                                    
                                    @if(auth()->user() && auth()->user()->isAdmin())
                                        <a href="{{ route('tracks.edit', $track) }}" class="btn btn-warning btn-sm">Edit</a>
                                        
                                        <form action="{{ route('tracks.destroy', $track) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
