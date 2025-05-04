@extends('layouts.app')

@section('content')
<div class="container py-3 py-md-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 pt-3 pt-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Appointment Details</h2>
                <a href="{{ route('client.appointments') }}" class="btn btn-outline-primary">
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
                        <div class="card-header bg-primary text-white">
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
                                        @if($appointment->coupon_code)
                                        <li class="mb-3">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-primary me-3">
                                                    <i class="fas fa-ticket-alt fa-fw fa-lg"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="text-muted small">Coupon Applied</div>
                                                    <div class="fw-bold">{{ $appointment->coupon_code }}</div>
                                                </div>
                                            </div>
                                        </li>
                                        @endif
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
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rescheduleModal">
                                        <i class="fas fa-calendar-alt me-2"></i> Reschedule
                                    </button>
                                    <form action="{{ route('client.appointments.cancel', $appointment) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to cancel this appointment?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-times me-2"></i> Cancel Appointment
                                        </button>
                                    </form>
                                </div>
                            @elseif($appointment->status === 'confirmed' && $appointment->start_time->isPast() && $appointment->end_time->isFuture())
                                <div class="alert alert-success mb-4">
                                    <i class="fas fa-info-circle me-2"></i> This appointment is currently in progress.
                                </div>
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <a href="{{ route('appointments.meeting', $appointment) }}" class="btn btn-success btn-lg">
                                        <i class="fas fa-video me-2"></i> Join Meeting
                                    </a>
                                </div>
                            @elseif($appointment->status === 'confirmed' && $appointment->end_time->isPast())
                                <div class="alert alert-info">
                                    <i class="fas fa-check-circle me-2"></i> This appointment has been completed.
                                </div>
                            @elseif($appointment->status === 'cancelled')
                                <div class="alert alert-danger">
                                    <i class="fas fa-times-circle me-2"></i> This appointment was cancelled.
                                    @if($appointment->last_rescheduled_at)
                                        <div class="mt-2 small">Last rescheduled: {{ $appointment->last_rescheduled_at->format('M d, Y g:i A') }}</div>
                                    @endif
                                </div>
                            @endif
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <a href="{{ route('appointments.meeting', $appointment) }}" class="btn btn-success btn-lg">
                                        <i class="fas fa-video me-2"></i> Join Meeting
                                    </a>
                                </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fas fa-user-md me-2"></i> Professional Details
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{ $appointment->professional->profile_photo_url }}" alt="{{ $appointment->professional->full_name }}" class="rounded-circle img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                                <h5 class="mt-3 mb-1">{{ $appointment->professional->first_name }} {{ $appointment->professional->last_name }}</h5>
                                <p class="text-muted mb-0">{{ $appointment->professional->specialization }}</p>
                            </div>
                            
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-primary me-3">
                                            <i class="fas fa-graduation-cap fa-fw"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="text-muted small">Qualification</div>
                                            <div>{{ $appointment->professional->qualification }}</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-3">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-primary me-3">
                                            <i class="fas fa-certificate fa-fw"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="text-muted small">License Number</div>
                                            <div>{{ $appointment->professional->license_number }}</div>
                                        </div>
                                    </div>
                                </li>
                                @if($appointment->professional->bio)
                                <li class="mb-3">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-primary me-3">
                                            <i class="fas fa-info-circle fa-fw"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="text-muted small">Bio</div>
                                            <div>{{ Str::limit($appointment->professional->bio, 150) }}</div>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            </ul>
                            
                            <div class="d-grid mt-4">
                                <a href="{{ route('professionals.show', $appointment->professional->slug) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-user me-2"></i> View Full Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reschedule Modal -->
@if($appointment->status === 'confirmed' && $appointment->start_time->isFuture())
<div class="modal fade" id="rescheduleModal" tabindex="-1" aria-labelledby="rescheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="rescheduleModalLabel">
                    <i class="fas fa-calendar-alt me-2"></i> Reschedule Appointment
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="rescheduleForm" 
                  class="reschedule-form"
                  action="{{ route('client.appointments.reschedule', $appointment) }}"
                  data-professional-id="{{ $appointment->professional->id }}"
                  data-duration="{{ $appointment->duration }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date" class="form-label">New Date</label>
                        <input type="date" class="form-control" id="date" name="date" required min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label">New Time</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>
                    <div id="availabilityMessage" class="alert" style="display: none;"></div>
                    @if($appointment->professional->settings)
                        <div class="alert alert-info">
                            <small>
                                <i class="fas fa-info-circle"></i>
                                You have {{ $appointment->professional->settings->max_reschedule_count - $appointment->reschedule_count }} reschedules remaining.
                            </small>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary reschedule-submit">
                        <i class="fas fa-calendar-check me-2"></i> Reschedule
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle reschedule form submission
    const rescheduleForm = document.getElementById('rescheduleForm');
    
    if (rescheduleForm) {
        // Add click event listener to the submit button
        const submitButton = rescheduleForm.querySelector('.reschedule-submit');
        submitButton.addEventListener('click', function(e) {
            e.preventDefault();
            
            const dateInput = document.getElementById('date');
            const timeInput = document.getElementById('time');
            const availabilityMessage = document.getElementById('availabilityMessage');
            const originalButtonText = this.innerHTML;
            
            // Validate inputs
            if (!dateInput.value || !timeInput.value) {
                availabilityMessage.textContent = 'Please select both date and time.';
                availabilityMessage.className = 'alert alert-danger';
                availabilityMessage.style.display = 'block';
                return;
            }
            
            // Show loading state
            this.disabled = true;
            this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Checking availability...';
            availabilityMessage.style.display = 'none';
            
            // Check availability first
            fetch(`/appointments/check-availability/${rescheduleForm.dataset.professionalId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    date: dateInput.value,
                    time: timeInput.value,
                    duration: rescheduleForm.dataset.duration
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.available) {
                    // Update button text for rescheduling
                    this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Rescheduling...';
                    
                    // If available, submit the reschedule request
                    fetch(rescheduleForm.action, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            date: dateInput.value,
                            time: timeInput.value,
                            _method: 'PUT'
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Show success message
                            availabilityMessage.textContent = data.message;
                            availabilityMessage.className = 'alert alert-success';
                            availabilityMessage.style.display = 'block';
                            
                            // Reload page after a short delay
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        } else {
                            // Show error message
                            availabilityMessage.textContent = data.message;
                            availabilityMessage.className = 'alert alert-danger';
                            availabilityMessage.style.display = 'block';
                            
                            // Reset button
                            this.disabled = false;
                            this.innerHTML = originalButtonText;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Show error message
                        availabilityMessage.textContent = 'An error occurred. Please try again.';
                        availabilityMessage.className = 'alert alert-danger';
                        availabilityMessage.style.display = 'block';
                        
                        // Reset button
                        this.disabled = false;
                        this.innerHTML = originalButtonText;
                    });
                } else {
                    // Show availability error
                    availabilityMessage.textContent = data.message;
                    availabilityMessage.className = 'alert alert-danger';
                    availabilityMessage.style.display = 'block';
                    
                    // Reset button
                    this.disabled = false;
                    this.innerHTML = originalButtonText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Show error message
                availabilityMessage.textContent = 'An error occurred while checking availability.';
                availabilityMessage.className = 'alert alert-danger';
                availabilityMessage.style.display = 'block';
                
                // Reset button
                this.disabled = false;
                this.innerHTML = originalButtonText;
            });
        });
        
        // Add event listeners for date and time inputs to check availability on change
        const dateInput = document.getElementById('date');
        const timeInput = document.getElementById('time');
        const availabilityMessage = document.getElementById('availabilityMessage');
        
        // Check availability when date or time changes
        const checkAvailability = () => {
            if (dateInput.value && timeInput.value) {
                availabilityMessage.style.display = 'none';
                
                fetch(`/appointments/check-availability/${rescheduleForm.dataset.professionalId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        date: dateInput.value,
                        time: timeInput.value,
                        duration: rescheduleForm.dataset.duration
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.available) {
                        availabilityMessage.textContent = 'Time slot is available!';
                        availabilityMessage.className = 'alert alert-success';
                    } else {
                        availabilityMessage.textContent = data.message;
                        availabilityMessage.className = 'alert alert-danger';
                    }
                    availabilityMessage.style.display = 'block';
                })
                .catch(error => {
                    console.error('Error:', error);
                    availabilityMessage.textContent = 'Error checking availability.';
                    availabilityMessage.className = 'alert alert-danger';
                    availabilityMessage.style.display = 'block';
                });
            }
        };
        
        dateInput.addEventListener('change', checkAvailability);
        timeInput.addEventListener('change', checkAvailability);
    }
    
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