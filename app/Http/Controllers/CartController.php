<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    // app/Http/Controllers/CartController.php

    public function add($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $book = Book::find($id);
        $cartItem = Cart::where('user_id', auth()->id())
            ->where('book_id', $id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'book_id' => $id,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Added to cart!');
    }

    public function index()
    {
        $carts = Cart::where('user_id', auth()->id())->with('book')->get();
        $grandTotal = $carts->sum(fn($c) => $c->book->price * $c->quantity);
        return view('cart', compact('carts', 'grandTotal'));
    }

    public function update(Request $request, $id)
    {
        Cart::where('id', $id)->update(['quantity' => $request->quantity]);
        return redirect()->back();
    }

    public function destroy($id)
    {
        Cart::where('id', $id)->delete();
        return redirect()->back();
    }

    public function checkout()
    {
        Cart::where('user_id', auth()->id())->delete();
        return redirect()->route('success');
    }
}
