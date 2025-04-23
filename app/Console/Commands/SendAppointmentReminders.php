<?php

namespace App\Console\Commands;

use App\Http\Controllers\AppointmentController;
use Illuminate\Console\Command;

class SendAppointmentReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointments:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders for upcoming appointments';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $controller = new AppointmentController();
        $controller->sendReminders();

        $this->info('Appointment reminders sent successfully.');
    }
}
