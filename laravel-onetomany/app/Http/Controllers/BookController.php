<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store(Request $request)
    {
        $bookData = $request->only('student_id', 'title');
        $book = Book::create($bookData);

        return response()->json($book, 201);
    }

    public function update(Request $request, Book $book)
    {
        $bookData = $request->only('student_id', 'title');
        $book->update($bookData);

        return response()->json($book, 200);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(null, 204);
    }

    public function index()
    {
        return Book::all();
    }
}
