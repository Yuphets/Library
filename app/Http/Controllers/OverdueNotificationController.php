<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Member;
use App\Mail\OverdueNotificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelPdf\Facades\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OverdueNotificationController extends Controller
{
   public function sendNotifications()
{
    $overdueLoans = Loan::with('book', 'member')
                        ->where('status', 'borrowed')
                        ->where('due_at', '<', now())
                        ->get()
                        ->groupBy('member_id');

    if ($overdueLoans->isEmpty()) {
        return redirect()->back()->with('info', 'No overdue loans to notify.');
    }

    $sentCount = 0;
    foreach ($overdueLoans as $memberId => $loans) {
        $member = $loans->first()->member;
        $totalFine = $this->calculateTotalFine($loans);

        // Generate a unique temporary file path
        $tempDir = storage_path('app/temp');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0755, true);
        }
        $tempPath = $tempDir . '/overdue-' . Str::uuid() . '.pdf';

        // Save PDF to temporary file
        Pdf::driver('dompdf')
            ->view('pdf.member-overdue', [
                'member' => $member,
                'overdueLoans' => $loans,
            ])
            ->format('A4')
            ->save($tempPath);

        // Send email with attachment using fromPath
        Mail::to($member->email)->send(new OverdueNotificationMail(
            $member,
            $loans,
            $totalFine,
            $tempPath
        ));

        // Clean up temporary file
        unlink($tempPath);

        $sentCount++;
    }

    return redirect()->back()->with('success', "Overdue notifications sent to {$sentCount} members.");
}

    private function calculateTotalFine($loans)
    {
        $finePerDay = config('app.overdue_fine_per_day', 5);
        $total = 0;
        foreach ($loans as $loan) {
            $days = floor(now()->diffInDays($loan->due_at));
            $total += $days * $finePerDay;
        }
        return $total;
    }
}