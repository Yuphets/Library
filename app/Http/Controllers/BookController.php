<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $books = Book::all();
    return view('books.index', compact('books'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('books.create');
}

public function edit(Book $book)
{
    return view('books.edit', compact('book'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'isbn' => 'required|string|unique:books,isbn',
        'publication_year' => 'nullable|integer|min:1800|max:' . date('Y'),
        'total_copies' => 'required|integer|min:1',
    ]);

    $validated['available_copies'] = $validated['total_copies'];
    Book::create($validated);

    return redirect()->route('books.index')->with('success', 'Book added successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'isbn' => 'required|string|unique:books,isbn,' . $book->id,
        'publication_year' => 'nullable|integer|min:1800|max:' . date('Y'),
        'total_copies' => 'required|integer|min:1',
    ]);

    // Ensure available_copies doesn't exceed new total_copies
    if ($validated['total_copies'] < $book->available_copies) {
        return back()->withErrors(['total_copies' => 'Total copies cannot be less than currently available copies.']);
    }

    $book->update($validated);

    return redirect()->route('books.index')->with('success', 'Book updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
{
    $book->delete();
    return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
}
}
