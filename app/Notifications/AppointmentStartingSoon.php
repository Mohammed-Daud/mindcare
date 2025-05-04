<?php

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentStartingSoon extends Notification implements ShouldQueue
{
    use Queueable;

    protected $appointment;

    /**
     * Create a new notification instance.
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $role = $notifiable instanceof \App\Models\Client ? 'client' : 'professional';
        $otherParty = $role === 'client' ? $this->appointment->professional : $this->appointment->client;

        return (new MailMessage)
            ->subject('Your Session is Starting Soon')
            ->line('Your session is starting in 10 minutes!')
            ->line("Session Details:")
            ->line("Date: " . $this->appointment->start_time->format('l, F j, Y'))
            ->line("Time: " . $this->appointment->start_time->format('g:i A') . " - " . $this->appointment->end_time->format('g:i A'))
            ->line($role === 'client' 
                ? "Professional: Dr. {$otherParty->first_name} {$otherParty->last_name}"
                : "Client: {$otherParty->name}")
            ->line('Please ensure you are ready for the session.')
            ->action('Join Session', route('appointments.jitsi', $this->appointment));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'appointment_id' => $this->appointment->id,
            'start_time' => $this->appointment->start_time,
            'end_time' => $this->appointment->end_time,
            'message' => 'Your session is starting in 10 minutes!',
        ];
    }
}
