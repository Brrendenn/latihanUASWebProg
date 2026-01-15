@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mx-auto" style="max-width: 600px">
        <div class="card-header">Edit Book</div>
        <div class="card-body">
            <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Current Photo:</label>
                    <img src="{{ asset('storage/' . $book->image_path) }}" alt="" width="100" class="mb-2">
                    <input type="file" name="image" class="form-control" required>
                    <small class="text-muted">Leave empty to keep current photo</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Book Title:</label>
                    <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price:</label>
                    <input type="number" name="price" class="form-control" value="{{ $book->price }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

@endsection