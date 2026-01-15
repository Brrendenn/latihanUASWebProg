<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    //
    public function index() {
        $books = Book::all();
        return view('admin.home', compact('books'));
    }

    public function create() {
        return view('admin.create');
    }
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        $path = $request->file('image')->store('books', 'public');

        Book::create([
            'title' => $request->title,
            'price' => $request->price,
            'image_path' => $path
        ]);

        return redirect()->route('admin.home');
    }

    public function edit($id) {
        $book = Book::findOrFail($id);
        return view('admin.edit', compact('book'));
    }

    public function update(Request $request, $id) {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048', // Image is optional on update
        ]);

        $data = [
            'title' => $request->title,
            'price' => $request->price,
        ];

        if($request->hasFile('image')) {
            if($book->image_path) {
                Storage::disk('public')->delete($book->image_path);
            }

            $data['image_path'] = $request->file('image')->store('books', 'public');
        }

        $book->update($data);

        return redirect()->route('admin.home')->with('success', 'Book updated successfully.');
    }

    public function destroy($id) {
        $book = Book::findOrFail($id);

        if($book->image_path) {
            Storage::disk('public')->delete($book->image_path);
        }

        $book->delete();

        return redirect()->back()->with('success', 'Book deleted successfully.');
    }
}
