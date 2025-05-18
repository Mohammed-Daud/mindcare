@extends('layouts.app')

@section('content')
<div class="container py-3 py-md-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 pt-3 pt-md-4">
            <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
                <div class="card-header" style="background-color: var(--primary); color: white;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-video me-2"></i> Virtual Meeting Room
                        </h4>
                        <span class="badge bg-light text-primary px-3 py-2 rounded-pill">
                            Appointment #{{ $appointment->id }}
                        </span>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                        </div>
                    @endif
                    
                    <div class="row mb-4">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title border-bottom pb-2 mb-3">
                                        <i class="fas fa-info-circle me-2 text-primary"></i> Meeting Information
                                    </h5>
                                    
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
                                                    <i class="fas fa-user fa-fw fa-lg"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="text-muted small">
                                                        {{ $isClient ? 'Professional' : 'Client' }}
                                                    </div>
                                                    <div class="fw-bold">
                                                        @if($isClient)
                                                            {{ $appointment->professional->first_name }} {{ $appointment->professional->last_name }}
                                                        @else
                                                            {{ $appointment->client->first_name }} {{ $appointment->client->last_name }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title border-bottom pb-2 mb-3">
                                        <i class="fas fa-clock me-2 text-primary"></i> Meeting Status
                                    </h5>
                                    
                                    @if($isInProgress)
                                        <div class="alert alert-success mb-4">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <i class="fas fa-play-circle fa-2x me-3"></i>
                                                </div>
                                                <div>
                                                    <h5 class="alert-heading">Meeting in Progress</h5>
                                                    <p class="mb-0">Your appointment is currently active. You can join the meeting now.</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="text-center mb-3">
                                            <div class="countdown-timer">
                                                <h6 class="text-muted mb-2">Time Remaining</h6>
                                                @php
                                                    $now = \Carbon\Carbon::now();
                                                    $minutesRemaining = $now->diffInMinutes($appointment->end_time);
                                                @endphp
                                                <div class="display-6 fw-bold text-primary" id="timer">
                                                    {{ floor($minutesRemaining / 60) }}:{{ str_pad($minutesRemaining % 60, 2, '0', STR_PAD_LEFT) }}
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-warning mb-4">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <i class="fas fa-hourglass-half fa-2x me-3"></i>
                                                </div>
                                                <div>
                                                    <h5 class="alert-heading">Meeting Starting Soon</h5>
                                                    <p class="mb-0">Your appointment will begin shortly. You can join the meeting now to prepare.</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="text-center mb-3">
                                            <div class="countdown-timer">
                                                <h6 class="text-muted mb-2">Time Until Start</h6>
                                                @php
                                                    $now = \Carbon\Carbon::now();
                                                    $diff = $now->diff($appointment->start_time);
                                                    $days = $diff->days;
                                                    $hours = $diff->h;
                                                    $minutes = $diff->i;
                                                    $seconds = $diff->s;
                                                @endphp
                                                <div class="countdown-display">
                                                    <div class="row text-center">
                                                        <div class="col-3">
                                                            <div class="fw-bold" id="countdown-days">{{ $days }}</div>
                                                            <div class="text-muted small">Days</div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="fw-bold" id="countdown-hours">{{ $hours }}</div>
                                                            <div class="text-muted small">Hours</div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="fw-bold" id="countdown-minutes">{{ $minutes }}</div>
                                                            <div class="text-muted small">Minutes</div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="fw-bold" id="countdown-seconds">{{ $seconds }}</div>
                                                            <div class="text-muted small">Seconds</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-none" id="appointment-start-time" data-start-time="{{ $appointment->start_time }}"></div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="meeting-controls bg-light p-4 rounded-3 mb-4">
                        <div class="row">
                            <div class="col-md-8 mb-3 mb-md-0">
                                <h5 class="mb-3">Join Meeting</h5>
                                <p class="text-muted mb-0">
                                    Click the button below to join your virtual meeting. Make sure your camera and microphone are working properly.
                                </p>
                            </div>
                            <div class="col-md-4 d-flex align-items-center justify-content-md-end">
                                <a href="{{ route('appointments.jitsi', $appointment) }}" class="btn btn-success btn-lg px-4 join-meeting-btn">
                                    <i class="fas fa-video me-2"></i> Join Now
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="meeting-tips">
                        <h5 class="mb-3">
                            <i class="fas fa-lightbulb me-2 text-warning"></i> Tips for a Successful Meeting
                        </h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 text-primary me-3">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0">Find a quiet, well-lit space with minimal distractions</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 text-primary me-3">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0">Test your camera and microphone before joining</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 text-primary me-3">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0">Ensure you have a stable internet connection</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 text-primary me-3">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0">Close unnecessary applications to improve performance</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer bg-light py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ $isClient ? route('client.appointments.show', $appointment) : route('professional.appointments.show', $appointment) }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i> Back to Appointment
                        </a>
                        <div>
                            <span class="text-muted">Need help? </span>
                            <a href="#" class="text-decoration-none">Contact Support</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<style>
    /* Gradient backgrounds */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    }
    
    /* Countdown timer styling */
    .countdown-timer {
        padding: 1rem;
        border-radius: 0.5rem;
        background-color: rgba(13, 110, 253, 0.05);
    }
    
    .countdown-display {
        margin-top: 0.5rem;
    }
    
    .countdown-display .fw-bold {
        font-size: 1.5rem;
        color: #0d6efd;
    }
    
    /* Meeting controls */
    .meeting-controls {
        border-left: 4px solid #198754;
    }
    
    /* Join button hover effect */
    .join-meeting-btn {
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .join-meeting-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
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
                if (!{{ $isInProgress ? 'true' : 'false' }}) {
                    location.reload();
                }
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
    
    // Timer functionality for in-progress appointments
    const timerElement = document.getElementById('timer');
    if (timerElement && {{ $isInProgress ? 'true' : 'false' }}) {
        let timeString = timerElement.textContent.trim();
        let parts = timeString.split(':');
        let minutes = parseInt(parts[0]) * 60 + parseInt(parts[1]);
        
        const updateTimer = function() {
            if (minutes <= 0) {
                timerElement.textContent = "00:00";
                clearInterval(timerInterval);
                location.reload();
                return;
            }
            
            minutes--;
            const displayMinutes = Math.floor(minutes / 60);
            const displaySeconds = minutes % 60;
            
            timerElement.textContent = 
                String(displayMinutes).padStart(2, '0') + ':' + 
                String(displaySeconds).padStart(2, '0');
        };
        
        const timerInterval = setInterval(updateTimer, 60000); // Update every minute
    }
    
    // Join meeting button functionality is now handled by the direct link to the Jitsi meeting
});
</script>
@endpush
@endsection