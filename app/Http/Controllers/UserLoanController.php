<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoanConfirmationMail;

class UserLoanController extends Controller
{
    /**
     * Display a listing of the authenticated user's loans.
     */
    public function index()
    {
        $user = Auth::user();
        // Find the corresponding member record
        $member = Member::where('email', $user->email)->first();

        if (!$member) {
            // If no member record exists, create one (just in case)
            $member = Member::create([
                'name' => $user->name,
                'email' => $user->email,
                'phone' => null,
                'address' => null,
                'membership_start' => now(),
            ]);
        }

        $loans = Loan::with('book')
                     ->where('member_id', $member->id)
                     ->orderBy('borrowed_at', 'desc')
                     ->get();

        return view('user.loans.index', compact('loans'));
    }

    /**
     * Store a newly created loan (borrow a book).
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        // Check if book is available
        if ($book->available_copies < 1) {
            return redirect()->back()->with('error', 'This book is not available for borrowing.');
        }

        $user = Auth::user();
        $member = Member::where('email', $user->email)->first();

        if (!$member) {
            $member = Member::create([
                'name' => $user->name,
                'email' => $user->email,
                'phone' => null,
                'address' => null,
                'membership_start' => now(),
            ]);
        }

        // Create loan
        $loan = Loan::create([
            'book_id' => $book->id,
            'member_id' => $member->id,
            'borrowed_at' => now(),
            'due_at' => now()->addDays(14),
            'status' => 'borrowed',
        ]);

        // Queue confirmation email (optional)
        try {
            Mail::to($member->email)->queue(new LoanConfirmationMail($loan));
        } catch (\Exception $e) {
            // Log error but don't break the flow
        }

        return redirect()->route('user.loans')->with('success', 'Book borrowed successfully!');
    }
}