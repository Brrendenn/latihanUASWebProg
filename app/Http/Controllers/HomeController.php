<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    public function index() {
        $books = Book::take(3)->get();
        return view('home', compact('books'));
    }
}
