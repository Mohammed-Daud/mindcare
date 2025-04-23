<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'professional_id',
        'start_time',
        'end_time',
        'status',
        'fee',
        'discount_amount',
        'coupon_code',
        'notes',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'fee' => 'decimal:2',
        'discount_amount' => 'decimal:2',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }

    public function getFinalFeeAttribute()
    {
        return $this->fee - $this->discount_amount;
    }

    public function getDurationAttribute()
    {
        return $this->start_time->diffInMinutes($this->end_time);
    }

    public function isUpcoming()
    {
        return $this->start_time->isFuture();
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }
}
