@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="bg-secondary text-white p-2">
            {{ __('text.home') }}
        </h2>
        <div class="row">
            @foreach($books as $book)
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <img src="https://tse3.mm.bing.net/th/id/OIP.ME5KNPeRlZZIHSwOp_-4bQHaE2?pid=Api&P=0&h=180" alt="" class="card-img-top">
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
@endsection