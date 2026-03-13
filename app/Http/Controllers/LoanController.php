<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use App\Mail\LoanConfirmationMail;
use Illuminate\Support\Facades\Mail;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // validate and create loan
    $loan = Loan::create([
        'book_id' => $request->book_id,
        'member_id' => $request->member_id,
        'borrowed_at' => now(),
        'due_at' => now()->addDays(14),
        'status' => 'borrowed',
    ]);

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
