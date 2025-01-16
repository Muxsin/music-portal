@extends('layouts.app')

@section('content')
    <h1>Edit Artist</h1>
    <form action="{{ route('artists.update', $artist) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $artist->name }}" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description">{{ $artist->description }}</textarea>
        </div>

        <div>
            <label for="type">Type:</label>
            <select name="type" id="type" required>
                <option value="Pop" {{ $artist->type == 'Pop' ? 'selected' : '' }}>Pop</option>
                <option value="Rock" {{ $artist->type == 'Rock' ? 'selected' : '' }}>Rock</option>
                <option value="Hip-Hop" {{ $artist->type == 'Hip-Hop' ? 'selected' : '' }}>Hip-Hop</option>
                <option value="Jazz" {{ $artist->type == 'Jazz' ? 'selected' : '' }}>Jazz</option>
                <option value="Classical" {{ $artist->type == 'Classical' ? 'selected' : '' }}>Classical</option>
            </select>
        </div>

        <button type="submit">Update</button>
    </form>

    <a href="{{ route('artists.index') }}">Back to List</a>
@endsection
