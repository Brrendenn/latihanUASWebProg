<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function add($bookId) {
        $cart = Cart::updateOrCreate(
            ['user_id' => auth()->id(), 'book_id' => $bookId],
            ['quantity' => \DB::raw('quantity + 1')]
        );

        return redirect()->back();
    }

    public function index() {
        $carts = Cart::where('user_id', auth()->id())->with('book')->get();
        $grandTotal = $carts->sum(fn($c) => $c->book->price * $c->quantity);
        return view('user.cart', compact('carts', 'grandTotal'));
    }

    public function update(Request $request, $id) {
        Cart::where('id', $id)->update(['quantity' => $request->quantity]);
        return redirect()->back();  
    }

    public function checkout() {
        Cart::where('user_id', auth()->id())->delete();
        return redirect()->route('success');
    }
}
