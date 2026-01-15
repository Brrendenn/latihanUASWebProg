@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ __('text.cart') }}</h2> @if($carts->isEmpty())
        <div class="alert alert-info">Your cart is empty.</div>
    @else
        @foreach ($carts as $cart)
        <div class="card mb-3">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <img src="{{ asset('storage/' . $cart->book->image_path) }}" class="img-fluid" style="height:100px; object-fit: contain;">
                    </div>

                    <div class="col-md-4">
                        <h5>{{ $cart->book->title }}</h5>
                        <p>Rp. {{ number_format($cart->book->price, 0, ',', '.') }}</p>
                    </div>

                    <div class="col-md-3">
                        <form action="{{ route('cart.update', $cart->id) }}" method="POST" class="d-flex align-items-center">
                            @csrf
                            @method('PATCH')
                            <label class="me-2">Qty:</label>
                            <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" class="form-control me-2" style="width: 80px;">
                            <button type="submit" class="btn btn-sm btn-secondary">Update</button>
                        </form>
                    </div>

                    <div class="col-md-3 text-end">
                        <form action="{{ route('cart.delete', $cart->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ __('text.delete') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="d-flex justify-content-between align-items-center mt-4 p-3 bg-light border">
            <h4>Grand Total: Rp. {{ number_format($grandTotal, 0, ',', '.') }}</h4>

            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-dark btn-lg">Checkout</button>
            </form>
        </div>
    @endif
</div>
@endsection