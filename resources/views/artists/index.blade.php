@extends('layouts.app')

@section('content')
    <h1>Artists</h1>
    
    @if(auth()->check() && auth()->user()->isAdmin())
        <a href="{{ route('artists.create') }}" class="btn btn-primary">Create Artist</a>
    @endif
    
    <ul>
        @foreach($artists as $artist)
            <li>
                {{ $artist->name }}
                <a href="{{ route('artists.show', $artist) }}">View</a>
                
                @if(auth()->check() && auth()->user()->isAdmin())
                    <a href="{{ route('artists.edit', $artist) }}">Edit</a>
                    <form action="{{ route('artists.destroy', $artist) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
@endsection
