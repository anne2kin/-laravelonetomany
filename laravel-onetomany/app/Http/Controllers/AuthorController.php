<?php

namespace App\Http\Controllers;

use  App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        return Author::with('books')->get();
    }

    public function store(Request $request)
    {
        $author = Author::create($request->all());
        if ($request->has('books')) {
            $author->books()->createMany($request->input('books'));
        }
        return response()->json(['author' => $author]);
    }

    public function update(Request $request, $id)
    {
        $author = Author::find($id);
        $author->update($request->all());
        return response()->json(['author' => $author]);
    }

    public function destroy($id)
    {
        $author = Author::find($id);
        $author->books()->delete();
        $author->delete();
        return response()->json(['message' => 'succesfully deleted data']);
    }
}
