<?php

namespace App\Mail;

use App\Models\Professional;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ApprovalEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $professional;
    public $password;

    /**
     * Create a new message instance.
     */
    public function __construct(Professional $professional, $password)
    {
        $this->professional = $professional;
        $this->password = $password;
        Log::info('ApprovalEmail constructed for: ' . $professional->email);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        Log::info('Creating envelope for approval email to: ' . $this->professional->email);
        return new Envelope(
            subject: 'Your Application Has Been Approved - MindCare Professional Counseling',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        Log::info('Building content for approval email to: ' . $this->professional->email);
        return new Content(
            view: 'emails.professional-approval',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
} 