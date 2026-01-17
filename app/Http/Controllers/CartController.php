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
        // 1. Ensure the user is logged in (Redundant if middleware is set, but safe)
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // 2. Find the book
        $book = Book::find($id);

        // 3. Add to Cart Logic
        // (This checks if the user already has this book in cart. If yes, add +1 qty. If no, create it.)
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

        // 4. THE FIX: Redirect to the Cart Page
        // This forces the page to change so you KNOW it worked.
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
