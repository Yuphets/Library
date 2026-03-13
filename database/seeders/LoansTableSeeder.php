<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Loan;
use App\Models\Book;
use App\Models\Member;
use Carbon\Carbon;

class LoansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $members = Member::all();
    $books = Book::all();

    foreach ($members as $member) {
        // Randomly decide how many loans this member has (0-3)
        $numLoans = rand(0, 3);
        for ($i = 0; $i < $numLoans; $i++) {
            // Pick a random book that has available copies > 0
            $availableBooks = $books->filter(function ($book) {
                return $book->available_copies > 0;
            });
            if ($availableBooks->isEmpty()) {
                break; // no more books available
            }
            $book = $availableBooks->random();

            // Randomly decide if this loan is:
            // - currently borrowed (status='borrowed', returned_at=null)
            // - returned (status='returned', returned_at set)
            // - overdue (status='borrowed', due_at in past)
            $statusRand = rand(1, 10);
            $borrowed_at = Carbon::now()->subDays(rand(0, 60));
            $due_at = (clone $borrowed_at)->addDays(14);

            if ($statusRand <= 6) { // 60% chance currently borrowed (some overdue, some not)
                $status = 'borrowed';
                $returned_at = null;
                // If we want some overdue, set due_at in past
                if (rand(0, 1)) { // 50% of borrowed are overdue
                    $due_at = Carbon::now()->subDays(rand(1, 10));
                } else {
                    $due_at = Carbon::now()->addDays(rand(1, 10));
                }
            } else { // 40% chance returned
                $status = 'returned';
                $returned_at = (clone $due_at)->addDays(rand(0, 5)); // returned sometime after due or before? could be early or late
                // If returned early, set returned_at before due_at? We'll keep simple: returned after due (could be early if returned_at < due_at)
                // To make it realistic, some returned early, some late.
                if (rand(0, 1)) {
                    // returned early
                    $returned_at = (clone $borrowed_at)->addDays(rand(1, 13));
                } else {
                    // returned late
                    $returned_at = (clone $due_at)->addDays(rand(1, 5));
                }
                // ensure returned_at not before borrowed_at
                if ($returned_at < $borrowed_at) {
                    $returned_at = (clone $borrowed_at)->addDays(1);
                }
            }

            Loan::create([
                'book_id' => $book->id,
                'member_id' => $member->id,
                'borrowed_at' => $borrowed_at,
                'due_at' => $due_at,
                'returned_at' => $returned_at,
                'status' => $status,
            ]);

            // The observer will handle updating available_copies, so we don't need to manually adjust.
            // But because we are in a seeder, the observer will fire. That's fine.
        }
    }
}
}
