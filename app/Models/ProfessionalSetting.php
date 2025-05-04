<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'professional_id',
        'session_durations',
        'session_fees',
        'working_hours',
        'working_days',
        'buffer_time',
        'is_available',
        'allow_client_reschedule',
        'max_reschedule_count'
    ];

    protected $casts = [
        'session_durations' => 'array',
        'session_fees' => 'array',
        'working_hours' => 'array',
        'working_days' => 'array',
        'buffer_time' => 'integer',
        'is_available' => 'boolean',
        'allow_client_reschedule' => 'boolean',
        'max_reschedule_count' => 'integer'
    ];

    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }

    public function getSessionFee($duration)
    {
        if (!$this->session_fees || !is_array($this->session_fees)) {
            // Default fee if none is set
            return 500; // Default fee of ₹500
        }
        
        // If session_fees is a simple array with one value, return that value
        if (count($this->session_fees) === 1 && isset($this->session_fees[0])) {
            return $this->session_fees[0];
        }
        
        // If it's a key-value pair array, find the matching duration
        foreach ($this->session_fees as $feeDuration => $fee) {
            if ((int)$feeDuration === (int)$duration) {
                return $fee;
            }
        }
        
        // If no matching duration found but we have fees, use the first one as default
        if (count($this->session_fees) > 0) {
            $firstKey = array_key_first($this->session_fees);
            return $this->session_fees[$firstKey];
        }
        
        // Fallback default fee
        return 500; // Default fee of ₹500
    }

    public function isWorkingDay($day)
    {
        return in_array($day, $this->working_days);
    }

    public function getWorkingHours($day)
    {
        return $this->working_hours[$day] ?? null;
    }

    public function isTimeSlotAvailable($startTime, $endTime)
    {
        // Check if the time slot is within working hours
        $day = $startTime->format('l');
        if (!$this->isWorkingDay($day)) {
            return false;
        }

        $workingHours = $this->getWorkingHours($day);
        if (!$workingHours) {
            return false;
        }

        $startHour = $workingHours['start'];
        $endHour = $workingHours['end'];

        if ($startTime->format('H:i') < $startHour || $endTime->format('H:i') > $endHour) {
            return false;
        }

        // Check for overlapping appointments
        $overlappingAppointments = Appointment::where('professional_id', $this->professional_id)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function ($q) use ($startTime, $endTime) {
                        $q->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                    });
            })
            ->where('status', '!=', 'cancelled')
            ->exists();

        return !$overlappingAppointments;
    }
}
