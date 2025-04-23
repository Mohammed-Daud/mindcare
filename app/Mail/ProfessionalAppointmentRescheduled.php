<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class ProfessionalAppointmentRescheduled extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;
    public $oldStartTime;

    public function __construct($appointment, $oldStartTime)
    {
        $this->appointment = $appointment;
        $this->oldStartTime = $oldStartTime;
    }

    public function build()
    {
        return $this->markdown('emails.appointments.professional-rescheduled')
            ->subject('Appointment Rescheduled by Client - MindCare')
            ->with([
                'appointment' => $this->appointment,
                'oldStartTime' => $this->oldStartTime,
                'clientName' => $this->appointment->client->name,
                'professionalName' => $this->appointment->professional->first_name . ' ' . $this->appointment->professional->last_name,
                'newDate' => $this->appointment->start_time->format('F j, Y'),
                'newTime' => $this->appointment->start_time->format('g:i A'),
                'oldDate' => Carbon::parse($this->oldStartTime)->format('F j, Y'),
                'oldTime' => Carbon::parse($this->oldStartTime)->format('g:i A'),
            ]);
    }
} 