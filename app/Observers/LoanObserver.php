<?php

namespace App\Observers;

use App\Models\Loan;
use App\Models\Book;

class LoanObserver
{
    /**
     * Handle the Loan "created" event.
     */
    public function created(Loan $loan): void
    {
        if ($loan->status === 'borrowed') {
            $book = $loan->book;
            $book->available_copies--;
            $book->save();
        }
    }

    /**
     * Handle the Loan "updated" event.
     */
    public function updated(Loan $loan): void
    {
        // Check if status changed to returned
        if ($loan->isDirty('status') && $loan->status === 'returned') {
            $book = $loan->book;
            $book->available_copies++;
            $book->save();
        }
    }
}