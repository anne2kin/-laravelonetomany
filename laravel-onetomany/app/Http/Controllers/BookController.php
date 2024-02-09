<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return response()->json(['books' => $books]);
    }

    public function store(Request $request)
    {
        return Book::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $book->update($request->all());
        return response()->json(['book' => $book]);
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return response()->json(['message' => "successfully deleted the data"]);
    }
}
