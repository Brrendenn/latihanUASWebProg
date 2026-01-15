@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('text.admin_home') }}</h2>
        <a href="{{ route('books.create') }}" class="btn btn-success">+ Add New Book</a>  
    </div>

    <div class="row">
        @foreach ($books as $book)
        <div class="col-md-4 mb-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <img src="{{ asset('storage/' . $book->image_path) }}" alt="{{ $book->title }}"
                        alt="{{ $book->title }}"
                        class="img-fluid mb-3"
                        style="max-height: 150px;">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text">Rp. {{ number_format($book->price, 0, ',', '.') }}</p>

                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">
                            {{ __('text.edit') }}
                        </a>
                        <form action="{{ route('books.delete', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE') <button type="submit" class="btn btn-danger">
                                {{ __('text.delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection