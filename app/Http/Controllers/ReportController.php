<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Spatie\LaravelPdf\Facades\Pdf;

class ReportController extends Controller
{
    public function overdueLoansPdf()
{
    $overdueLoans = Loan::with('book', 'member')
                        ->where('status', 'borrowed')
                        ->where('due_at', '<', now())
                        ->get();

    return Pdf::view('pdf.overdue-loans', compact('overdueLoans'))
              ->format('A4')
              ->name('overdue-loans-'.now()->format('Y-m-d').'.pdf');
}
}