@extends('layouts.app')

@section('content')
    <h1>Artist: {{ $artist->name }}</h1>

    <div>
        <strong>Description:</strong>
        <p>{{ $artist->description ?? 'No description available' }}</p>
    </div>

    <div>
        <strong>Type:</strong>
        <p>{{ $artist->type }}</p>
    </div>

    <a href="{{ route('artists.index') }}">Back to List</a>
@endsection
