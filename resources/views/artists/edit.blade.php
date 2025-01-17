@extends('layouts.app')

@section('content')
    <div>
        <h1>Edit Artist</h1>
        <form action="{{ route('artists.update', $artist) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $artist->name }}" required>
                </div>
                <div class="col-md-6">
                    <label for="type" class="form-label">Type:</label>
                    <select name="type" id="type" class="form-select" required>
                        <option value="Pop" {{ $artist->type == 'Pop' ? 'selected' : '' }}>Pop</option>
                        <option value="Rock" {{ $artist->type == 'Rock' ? 'selected' : '' }}>Rock</option>
                        <option value="Hip-Hop" {{ $artist->type == 'Hip-Hop' ? 'selected' : '' }}>Hip-Hop</option>
                        <option value="Jazz" {{ $artist->type == 'Jazz' ? 'selected' : '' }}>Jazz</option>
                        <option value="Classical" {{ $artist->type == 'Classical' ? 'selected' : '' }}>Classical</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ $artist->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <div class="d-flex">
                    <input type="file" name="image" id="image" class="form-control-file">
                    @if($artist->image)
                        <img src="{{ asset('storage/'.$artist->image) }}" alt="Artist Image" class="ms-3 img-thumbnail shadow" width="100">
                    @endif
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('artists.index') }}" class="btn btn-secondary ms-2">Back to List</a>
            </div>
        </form>
    </div>
@endsection
 