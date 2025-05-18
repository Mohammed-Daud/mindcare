@extends('layouts.app')

@section('content')
<div class="container py-3 py-md-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 pt-3 pt-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Appointment Details</h2>
                <a href="{{ route('professional.appointments') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i> Back to Appointments
                </a>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                </div>
            @endif
            
            <div class="row">
                <div class="col-12 col-md-8 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header" style="background-color: var(--primary); color: white;">
                            <h5 class="mb-0">
                                <i class="fas fa-calendar-check me-2"></i> 
                                Appointment #{{ $appointment->id }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-12 col-md-6 mb-4 mb-md-0">
                                    <h5 class="border-bottom pb-2 mb-3">Appointment Information</h5>
                                    <ul class="list-unstyled">
                                        <li class="mb-3">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-primary me-3">
                                                    <i class="far fa-calendar-alt fa-fw fa-lg"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="text-muted small">Date</div>
                                                    <div class="fw-bold">{{ $appointment->start_time->format('l, F d, Y') }}</div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="mb-3">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-primary me-3">
                                                    <i class="far fa-clock fa-fw fa-lg"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="text-muted small">Time</div>
                                                    <div class="fw-bold">{{ $appointment->start_time->format('g:i A') }} - {{ $appointment->end_time->format('g:i A') }}</div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="mb-3">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-primary me-3">
                                                    <i class="fas fa-hourglass-half fa-fw fa-lg"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="text-muted small">Duration</div>
                                                    <div class="fw-bold">{{ $appointment->duration }} minutes</div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="mb-3">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-primary me-3">
                                                    <i class="fas fa-tag fa-fw fa-lg"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="text-muted small">Status</div>
                                                    <div>
                                                        <span class="badge bg-{{ $appointment->status === 'confirmed' ? 'success' : ($appointment->status === 'cancelled' ? 'danger' : 'warning') }} px-3 py-2">
                                                            {{ ucfirst($appointment->status) }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h5 class="border-bottom pb-2 mb-3">Payment Information</h5>
                                    <ul class="list-unstyled">
                                        <li class="mb-3">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-primary me-3">
                                                    <i class="fas fa-rupee-sign fa-fw fa-lg"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="text-muted small">Session Fee</div>
                                                    <div class="fw-bold">₹{{ $appointment->fee }}</div>
                                                </div>
                                            </div>
                                        </li>
                                        @if($appointment->discount_amount > 0)
                                        <li class="mb-3">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-primary me-3">
                                                    <i class="fas fa-percent fa-fw fa-lg"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="text-muted small">Discount</div>
                                                    <div class="fw-bold text-success">-₹{{ $appointment->discount_amount }}</div>
                                                </div>
                                            </div>
                                        </li>
                                        @endif
                                        <li class="mb-3">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-primary me-3">
                                                    <i class="fas fa-money-bill-wave fa-fw fa-lg"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="text-muted small">Total Amount</div>
                                                    <div class="fw-bold fs-5">₹{{ $appointment->fee - $appointment->discount_amount }}</div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            @if($appointment->status === 'confirmed' && $appointment->start_time->isFuture())
                                <div class="card bg-light mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-hourglass-half me-2 text-primary"></i> Time Remaining
                                        </h5>
                                        <div class="row text-center countdown-container">
                                            @php
                                                $now = \Carbon\Carbon::now();
                                                $diff = $now->diff($appointment->start_time);
                                                $days = $diff->days;
                                                $hours = $diff->h;
                                                $minutes = $diff->i;
                                                $seconds = $diff->s;
                                            @endphp
                                            <div class="col-3">
                                                <div class="display-6 fw-bold" id="countdown-days">{{ $days }}</div>
                                                <div class="text-muted">Days</div>
                                            </div>
                                            <div class="col-3">
                                                <div class="display-6 fw-bold" id="countdown-hours">{{ $hours }}</div>
                                                <div class="text-muted">Hours</div>
                                            </div>
                                            <div class="col-3">
                                                <div class="display-6 fw-bold" id="countdown-minutes">{{ $minutes }}</div>
                                                <div class="text-muted">Minutes</div>
                                            </div>
                                            <div class="col-3">
                                                <div class="display-6 fw-bold" id="countdown-seconds">{{ $seconds }}</div>
                                                <div class="text-muted">Seconds</div>
                                            </div>
                                        </div>
                                        <div class="d-none" id="appointment-start-time" data-start-time="{{ $appointment->start_time }}"></div>
                                    </div>
                                </div>
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <form action="{{ route('professional.appointments.update-status', $appointment) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                            <i class="fas fa-times me-2"></i> Cancel Appointment
                                        </button>
                                    </form>
                                </div>
                            @elseif($appointment->status === 'confirmed' && $appointment->start_time->isPast() && $appointment->end_time->isFuture())
                                <div class="alert alert-success mb-4">
                                    <i class="fas fa-info-circle me-2"></i> This appointment is currently in progress.
                                </div>
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <a href="{{ route('appointments.jitsi', $appointment) }}" class="btn btn-success btn-lg">
                                        <i class="fas fa-video me-2"></i> Join Meeting
                                    </a>
                                </div>
                            @elseif($appointment->status === 'confirmed' && $appointment->end_time->isPast())
                                <div class="alert alert-info">
                                    <i class="fas fa-check-circle me-2"></i> This appointment has been completed.
                                </div>
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <form action="{{ route('professional.appointments.update-status', $appointment) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-check-circle me-2"></i> Mark as Completed
                                        </button>
                                    </form>
                                </div>
                            @elseif($appointment->status === 'cancelled')
                                <div class="alert alert-danger">
                                    <i class="fas fa-times-circle me-2"></i> This appointment was cancelled.
                                    @if($appointment->last_rescheduled_at)
                                        <div class="mt-2 small">Last rescheduled: {{ $appointment->last_rescheduled_at->format('M d, Y g:i A') }}</div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header" style="background-color: var(--primary); color: white;">
                            <h5 class="mb-0">
                                <i class="fas fa-user me-2"></i> Client Details
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <div class="avatar-circle bg-primary text-white mx-auto mb-3">
                                    <span>{{ substr($appointment->client->first_name, 0, 1) }}{{ substr($appointment->client->last_name, 0, 1) }}</span>
                                </div>
                                <h5 class="mb-1">{{ $appointment->client->first_name }} {{ $appointment->client->last_name }}</h5>
                                <p class="text-muted mb-0">Client</p>
                            </div>
                            
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-primary me-3">
                                            <i class="fas fa-envelope fa-fw"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="text-muted small">Email</div>
                                            <div>{{ $appointment->client->email }}</div>
                                        </div>
                                    </div>
                                </li>
                                @if($appointment->client->phone)
                                <li class="mb-3">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-primary me-3">
                                            <i class="fas fa-phone fa-fw"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="text-muted small">Phone</div>
                                            <div>{{ $appointment->client->phone }}</div>
                                        </div>
                                    </div>
                                </li>
                                @endif
                                <li class="mb-3">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-primary me-3">
                                            <i class="fas fa-calendar-plus fa-fw"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="text-muted small">Joined</div>
                                            <div>{{ $appointment->client->created_at->format('M d, Y') }}</div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            
                            @if($appointment->notes)
                            <div class="mt-4">
                                <h6 class="border-bottom pb-2 mb-3">Notes</h6>
                                <p class="mb-0">{{ $appointment->notes }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<style>
    .avatar-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.5rem;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Countdown timer functionality
    const startTimeElement = document.getElementById('appointment-start-time');
    const daysElement = document.getElementById('countdown-days');
    const hoursElement = document.getElementById('countdown-hours');
    const minutesElement = document.getElementById('countdown-minutes');
    const secondsElement = document.getElementById('countdown-seconds');
    
    if (startTimeElement && daysElement && hoursElement && minutesElement && secondsElement) {
        const startTime = new Date(startTimeElement.getAttribute('data-start-time'));
        
        const updateCountdown = function() {
            const now = new Date();
            const diff = startTime - now;
            
            if (diff <= 0) {
                daysElement.textContent = "0";
                hoursElement.textContent = "0";
                minutesElement.textContent = "0";
                secondsElement.textContent = "0";
                
                // Reload the page when time is up
                location.reload();
                clearInterval(countdownInterval);
                return;
            }
            
            // Calculate days, hours, minutes, and seconds
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);
            
            // Update the display
            daysElement.textContent = days;
            hoursElement.textContent = hours;
            minutesElement.textContent = minutes;
            secondsElement.textContent = seconds;
        };
        
        // Initial update
        updateCountdown();
        
        // Update every second
        const countdownInterval = setInterval(updateCountdown, 1000);
    }
});
</script>
@endpush
@endsection