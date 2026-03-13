<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Spatie\LaravelPdf\Facades\Pdf;

class ReportController extends Controller
{
    /**
     * Display the reports page with lists of borrowed and overdue books.
     */
    public function index()
    {
        // Currently borrowed books (not returned yet)
        $borrowedBooks = Loan::with('book', 'member')
                             ->where('status', 'borrowed')
                             ->orderBy('borrowed_at', 'desc')
                             ->get();

        // Overdue books (borrowed and past due date)
        $overdueBooks = Loan::with('book', 'member')
                            ->where('status', 'borrowed')
                            ->where('due_at', '<', now())
                            ->orderBy('due_at', 'asc')
                            ->get();

        return view('reports.index', compact('borrowedBooks', 'overdueBooks'));
    }

    /**
     * Generate and download PDF of overdue loans.
     */
    public function overdueLoansPdf()
    {
        $overdueLoans = Loan::with('book', 'member')
                            ->where('status', 'borrowed')
                            ->where('due_at', '<', now())
                            ->get();

        return Pdf::driver('dompdf')
            ->view('pdf.overdue-loans', compact('overdueLoans'))
            ->format('A4')
            ->name('overdue-loans-'.now()->format('Y-m-d').'.pdf');
    }

    /**
     * Optional: Generate PDF of all currently borrowed books.
     */
    public function borrowedBooksPdf()
    {
        $borrowedBooks = Loan::with('book', 'member')
                             ->where('status', 'borrowed')
                             ->orderBy('borrowed_at', 'desc')
                             ->get();

        return Pdf::driver('dompdf')
            ->view('pdf.borrowed-books', compact('borrowedBooks'))
            ->format('A4')
            ->name('borrowed-books-'.now()->format('Y-m-d').'.pdf');
    }
}