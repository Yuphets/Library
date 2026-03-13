<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use App\Mail\LoanConfirmationMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Book;
use App\Models\Member;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $loans = Loan::with('book', 'member')->get();
    return view('loans.index', compact('loans'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $books = Book::where('available_copies', '>', 0)->get();
    $members = Member::all();
    return view('loans.create', compact('books', 'members'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // validate and create loan
   $validated = $request->validate([
        'book_id' => 'required|exists:books,id',
        'member_id' => 'required|exists:members,id',
        'borrowed_at' => 'required|date',
        'due_at' => 'required|date|after:borrowed_at',
    ]);

    $validated['status'] = 'borrowed';
    $loan = Loan::create($validated);

    // Queue email
    Mail::to($loan->member->email)->queue(new LoanConfirmationMail($loan));

    return redirect()->route('loans.index')->with('success', 'Loan created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
{
    $books = Book::where('available_copies', '>', 0)->orWhere('id', $loan->book_id)->get();
    $members = Member::all();
    return view('loans.edit', compact('loan', 'books', 'members'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
{
    $validated = $request->validate([
        'book_id' => 'required|exists:books,id',
        'member_id' => 'required|exists:members,id',
        'borrowed_at' => 'required|date',
        'due_at' => 'required|date|after:borrowed_at',
        'returned_at' => 'nullable|date|after_or_equal:borrowed_at',
        'status' => 'required|in:borrowed,returned',
    ]);

    $loan->update($validated);

    return redirect()->route('loans.index')->with('success', 'Loan updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
{
    $loan->delete();
    return redirect()->route('loans.index')->with('success', 'Loan deleted successfully.');
}

    public function returnBook(Loan $loan)
{
    $loan->update([
        'returned_at' => now(),
        'status' => 'returned'
    ]);

    return redirect()->route('loans.index')->with('success', 'Book returned successfully.');
}
}
