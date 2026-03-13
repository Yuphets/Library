<?php

namespace App\Mail;

use App\Models\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class OverdueNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $member;
    public $overdueLoans;
    public $totalFine;
    protected $pdfPath;

    public function __construct(Member $member, $overdueLoans, $totalFine, $pdfPath)
    {
        $this->member = $member;
        $this->overdueLoans = $overdueLoans;
        $this->totalFine = $totalFine;
        $this->pdfPath = $pdfPath;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Overdue Book Notification - Mater Dei College Library',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.overdue-notification',
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->pdfPath)
                ->as('overdue-notice.pdf')
                ->withMime('application/pdf'),
        ];
    }
}