<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;

    /**
     * Create a new message instance.
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reminder: Your Session Tomorrow - MindCare',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.appointments.reminder',
            with: [
                'clientName' => $this->appointment->client->name,
                'professionalName' => $this->appointment->professional->full_name,
                'date' => $this->appointment->start_time->format('l, F j, Y'),
                'startTime' => $this->appointment->start_time->format('g:i A'),
                'endTime' => $this->appointment->end_time->format('g:i A'),
                'duration' => $this->appointment->duration,
                'sessionUrl' => url('/session/' . $this->appointment->id),
            ],
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
