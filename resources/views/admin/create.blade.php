@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mx-auto" style="max-width: 600px">
        <div class="card-header">{{ __('text.book_admin') }}</div>
        <div class="card-body">
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ __('text.photo') }}</label>
                    <input type="file" name="image" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('text.book_title') }}</label>
                    <input type="text" name="title" class="form-control" placeholder="Ex: Belajar Laravel" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('text.price') }}</label>
                    <input type="number" name="price" class="form-control" placeholder="Ex: 100000" required>
                </div>

                <button type="submit" class="btn btn-dark">{{ __('text.submit') }}</button>
            </form>
        </div>
    </div>
</div>

@endsection