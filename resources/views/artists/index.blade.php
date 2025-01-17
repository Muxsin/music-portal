@extends('layouts.app')

@section('content')
    <div>
        <h1 class="mb-4">Artists</h1>

        @if(auth()->user() && auth()->user()->isAdmin())
            <a href="{{ route('artists.create') }}" class="btn btn-success mb-3">Create Artist</a>
        @endif

        <div class="row">
            @foreach($artists as $artist)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                @if($artist->image)
                                    <img src="{{ asset('storage/'.$artist->image) }}" alt="Artist Image" class="img-thumbnail shadow" width="80" style="margin-right: 15px;">
                                @else
                                    <img src="{{ asset('storage/default-image.jpg') }}" alt="Default Image" class="img-thumbnail shadow" width="80" style="margin-right: 15px;">
                                @endif
                                <span>{{ $artist->name }}</span>
                            </div>
                                <span>
                                    <a href="{{ route('artists.show', $artist) }}" class="btn btn-info btn-sm">View</a>
                                
                                @if(auth()->user() && auth()->user()->isAdmin())
                                    <a href="{{ route('artists.edit', $artist) }}" class="btn btn-warning btn-sm">Edit</a>
                                    
                                    <form action="{{ route('artists.destroy', $artist) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
