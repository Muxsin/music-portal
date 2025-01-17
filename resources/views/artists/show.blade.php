@extends('layouts.app')

@section('content')
    <div class="container-sm mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1>
                    {{ $artist->name }}
                    @auth
                        <form action="/favorites/{{ $artist->id }}" method="POST" style="display:inline;">
                            @csrf
                            @if(auth()->user()->favorites()->where('artist_id', $artist->id)->exists())
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger">
                                    <i class="fas fa-heart"></i>
                                </button>
                            @else
                                <button type="submit" class="btn btn-link text-muted">
                                    <i class="fas fa-heart"></i>
                                </button>
                            @endif
                        </form>
                    @endauth
                </h1>
                <p><strong>Type:</strong> {{ ucfirst($artist->type) }}</p>
                <p><strong>Description:</strong> {{ $artist->description ?? 'No description available.' }}</p>
            </div>
            
            <div class="col-md-6 text-center">
                @if($artist->image)
                    <img src="{{ asset('storage/'.$artist->image) }}" alt="{{ $artist->name }}" class="img-fluid border rounded shadow-lg">
                @else
                    <p>No image available</p>
                @endif
            </div>
        </div>

        <a href="{{ route('artists.index') }}" class="btn btn-primary mt-4">Back to List</a>
    </div>
@endsection
