<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Loan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $availableBooks = Book::sum('available_copies');
        $totalMembers = Member::count();
        $activeLoans = Loan::where('status', 'borrowed')->count();
        $overdueLoans = Loan::where('status', 'borrowed')
                            ->where('due_at', '<', now())
                            ->count();

        return view('dashboard', compact(
            'totalBooks',
            'availableBooks',
            'totalMembers',
            'activeLoans',
            'overdueLoans'
        ));
    }
}