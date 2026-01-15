@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="bg-secondary text-white p-2">{{ __('text.home') }}</h2> <div class="row">
        @foreach ($books as $book)
        <div class="col-md-4">
            <div class="card-mb-4 text-center">
                <img src="{{ asset('storage/' . $book->image_path) }}" class="card-img-top" style="height:200px; object-fit: contain;" alt="">
                <div class="card-body">
                    <h5>{{ $book->title }}</h5>
                    <p>Rp. {{ number_format($book->price) }}</p>
                    <form action="{{ route('cart.add', $book->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">{{ __('text.buy') }}</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
