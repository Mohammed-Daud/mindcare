@extends('layouts.app')

@section('content')
<div class="container pt-3 pt-md-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8 py-3 py-md-5">
            <!-- Promotional Banner -->
            <div class="card shadow mb-4 border-success">
                <div class="card-body bg-success bg-opacity-10">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-gift fa-2x text-success"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="text-success mb-1">Special Offer: 100% Free First Session!</h5>
                            <p class="mb-0 small">Use code <strong class="text-success">WELCOME100</strong> to get your first session completely free.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="{{ $professional->profile_photo_url }}" alt="{{ $professional->full_name }}" class="rounded-circle" width="40" height="40">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0">Book with {{ $professional->first_name }} {{ $professional->last_name }}</h5>
                            <p class="mb-0 small text-white-50">{{ $professional->specialization }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="mb-4 d-md-flex">
                        <div class="d-none d-md-block me-3">
                            <img src="{{ $professional->profile_photo_url }}" alt="{{ $professional->full_name }}" class="rounded-circle" width="80" height="80">
                        </div>
                        <div>
                            <h5 class="mb-2">Professional Details</h5>
                            <p class="mb-1 small"><i class="fas fa-user-md me-2 text-primary"></i> {{ $professional->specialization }}</p>
                            <p class="mb-1 small"><i class="fas fa-graduation-cap me-2 text-primary"></i> {{ $professional->qualification }}</p>
                            <p class="mb-0 small"><i class="fas fa-certificate me-2 text-primary"></i> License: {{ $professional->license_number }}</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('client.appointments.store', $professional->id) }}" id="appointmentForm">
                        @csrf

                        <div class="mb-4">
                            <h5 class="border-bottom pb-2 mb-3">1. Choose Session Duration</h5>
                            <div class="row g-2">
                                @if($settings && isset($settings->session_durations))
                                    @foreach($settings->session_durations as $duration)
                                        <div class="col-6 col-md-4">
                                            <div class="form-check custom-radio-card">
                                                <input class="form-check-input visually-hidden" type="radio" name="duration" 
                                                    id="duration{{ $duration }}" value="{{ $duration }}" required>
                                                <label class="form-check-label duration-card card h-100 w-100" for="duration{{ $duration }}">
                                                    <div class="card-body text-center p-2">
                                                        <i class="fas fa-clock mb-2 text-primary"></i>
                                                        <h6 class="mb-0">{{ $duration }} min</h6>
                                                        @if($settings->getSessionFee($duration))
                                                            <small class="text-muted">₹{{ $settings->getSessionFee($duration) }}</small>
                                                        @endif
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-6 col-md-4">
                                        <div class="form-check custom-radio-card">
                                            <input class="form-check-input visually-hidden" type="radio" name="duration" 
                                                id="duration30" value="30" required>
                                            <label class="form-check-label duration-card card h-100 w-100" for="duration30">
                                                <div class="card-body text-center p-2">
                                                    <i class="fas fa-clock mb-2 text-primary"></i>
                                                    <h6 class="mb-0">30 min</h6>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check custom-radio-card">
                                            <input class="form-check-input visually-hidden" type="radio" name="duration" 
                                                id="duration60" value="60" required>
                                            <label class="form-check-label duration-card card h-100 w-100" for="duration60">
                                                <div class="card-body text-center p-2">
                                                    <i class="fas fa-clock mb-2 text-primary"></i>
                                                    <h6 class="mb-0">60 min</h6>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @error('duration')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <h5 class="border-bottom pb-2 mb-3">2. Select Date</h5>
                            <div class="date-picker-container mb-3">
                                <div id="datePicker" class="date-picker"></div>
                                <input type="hidden" id="date" name="date" required>
                            </div>
                            @error('date')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <h5 class="border-bottom pb-2 mb-3">3. Select Available Time Slot</h5>
                            <div id="timeSlots" class="row g-2">
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i> Please select a date and duration first to see available time slots.
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="time" name="time" required>
                            @error('time')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <h5 class="border-bottom pb-2 mb-3">4. Apply Coupon (Optional)</h5>
                            <div class="input-group">
                                <input type="text" class="form-control @error('coupon_code') is-invalid @enderror" 
                                    id="coupon_code" name="coupon_code" value="WELCOME100" placeholder="Enter coupon code">
                                <button class="btn btn-outline-secondary" type="button" id="clearCoupon">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <small class="text-muted mt-2 d-block">
                                <i class="fas fa-info-circle"></i> Default coupon "WELCOME100" gives you 100% discount on your first session!
                            </small>
                            @error('coupon_code')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <h5 class="border-bottom pb-2 mb-3">5. Additional Notes (Optional)</h5>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                id="notes" name="notes" rows="2" placeholder="Any specific concerns or information you'd like to share"></textarea>
                            @error('notes')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="appointment-summary card bg-light mb-4 d-none" id="appointmentSummary">
                            <div class="card-body">
                                <h5 class="card-title">Appointment Summary</h5>
                                <ul class="list-unstyled mb-0">
                                    <li><i class="far fa-calendar me-2"></i> <span id="summaryDate">-</span></li>
                                    <li><i class="far fa-clock me-2"></i> <span id="summaryTime">-</span></li>
                                    <li><i class="fas fa-hourglass-half me-2"></i> <span id="summaryDuration">-</span> minutes</li>
                                </ul>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg" id="bookButton" disabled>
                                <i class="fas fa-calendar-check me-2"></i> Book Appointment
                            </button>
                            <a href="{{ route('client.appointments') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Back to Appointments
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<style>
    /* Custom styles for the appointment booking page */
    .custom-radio-card input[type="radio"]:checked + .duration-card {
        border-color: #0d6efd;
        background-color: rgba(13, 110, 253, 0.1);
    }
    
    .duration-card {
        cursor: pointer;
        transition: all 0.2s ease;
        border: 2px solid #dee2e6;
    }
    
    .duration-card:hover {
        border-color: #0d6efd;
        background-color: rgba(13, 110, 253, 0.05);
    }
    
    .time-slot-card {
        cursor: pointer;
        transition: all 0.2s ease;
        border: 2px solid #dee2e6;
    }
    
    .time-slot-card:hover {
        border-color: #0d6efd;
        background-color: rgba(13, 110, 253, 0.05);
    }
    
    .time-slot-card.selected {
        border-color: #0d6efd;
        background-color: rgba(13, 110, 253, 0.1);
    }
    
    .flatpickr-day.working-day {
        background-color: rgba(13, 110, 253, 0.1);
        border-color: transparent;
    }
    
    .flatpickr-day.working-day:hover {
        background-color: rgba(13, 110, 253, 0.2);
    }
    
    .flatpickr-day.working-day.selected {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: white;
    }
    
    .date-picker-container {
        max-width: 100%;
        overflow-x: auto;
    }
    
    @media (max-width: 768px) {
        .flatpickr-calendar {
            width: 100%;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('date');
        const timeInput = document.getElementById('time');
        const durationInputs = document.querySelectorAll('input[name="duration"]');
        const form = document.getElementById('appointmentForm');
        const timeSlotsContainer = document.getElementById('timeSlots');
        const bookButton = document.getElementById('bookButton');
        const appointmentSummary = document.getElementById('appointmentSummary');
        const summaryDate = document.getElementById('summaryDate');
        const summaryTime = document.getElementById('summaryTime');
        const summaryDuration = document.getElementById('summaryDuration');
        
        // Working days from professional settings
        const workingDays = @json($settings->working_days ?? []);
        
        // Initialize date picker with working days highlighted
        const datePicker = flatpickr("#datePicker", {
            inline: true,
            minDate: "today",
            dateFormat: "Y-m-d",
            disable: [
                function(date) {
                    // Disable days that are not working days
                    const day = date.toLocaleDateString('en-US', { weekday: 'long' });
                    return !workingDays.includes(day);
                }
            ],
            onChange: function(selectedDates, dateStr) {
                dateInput.value = dateStr;
                checkAndLoadTimeSlots();
            }
        });
        
        // Handle duration selection
        durationInputs.forEach(input => {
            input.addEventListener('change', function() {
                checkAndLoadTimeSlots();
            });
        });
        
        // Function to check if all required fields are filled
        function checkRequiredFields() {
            const date = dateInput.value;
            const time = timeInput.value;
            const duration = document.querySelector('input[name="duration"]:checked')?.value;
            
            if (date && time && duration) {
                bookButton.disabled = false;
                appointmentSummary.classList.remove('d-none');
                
                // Update summary
                const formattedDate = new Date(date).toLocaleDateString('en-US', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                
                summaryDate.textContent = formattedDate;
                
                // Format time for display (convert from 24h to 12h format)
                const timeParts = time.split(':');
                let hours = parseInt(timeParts[0]);
                const minutes = timeParts[1];
                const ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12;
                hours = hours ? hours : 12; // Convert 0 to 12
                const formattedTime = `${hours}:${minutes} ${ampm}`;
                
                summaryTime.textContent = formattedTime;
                summaryDuration.textContent = duration;
            } else {
                bookButton.disabled = true;
                appointmentSummary.classList.add('d-none');
            }
        }
        
        // Function to load available time slots
        function loadTimeSlots(date, duration) {
            timeSlotsContainer.innerHTML = '<div class="col-12"><div class="d-flex justify-content-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div></div>';
            
            fetch(`{{ route('appointments.check-availability', $professional->id) }}?date=${date}&duration=${duration}`)
                .then(response => response.json())
                .then(data => {
                    timeSlotsContainer.innerHTML = '';
                    
                    if (data.available && data.slots && data.slots.length > 0) {
                        data.slots.forEach(slot => {
                            // Create time slot card
                            const col = document.createElement('div');
                            col.className = 'col-6 col-md-4 col-lg-3';
                            
                            const card = document.createElement('div');
                            card.className = 'card time-slot-card mb-2';
                            card.dataset.time = slot.start;
                            
                            const cardBody = document.createElement('div');
                            cardBody.className = 'card-body text-center p-2';
                            
                            // Format time for display (convert from 24h to 12h format)
                            const timeParts = slot.start.split(':');
                            let hours = parseInt(timeParts[0]);
                            const minutes = timeParts[1];
                            const ampm = hours >= 12 ? 'PM' : 'AM';
                            hours = hours % 12;
                            hours = hours ? hours : 12; // Convert 0 to 12
                            const formattedTime = `${hours}:${minutes} ${ampm}`;
                            
                            cardBody.innerHTML = `
                                <i class="far fa-clock mb-1 text-primary"></i>
                                <h6 class="mb-0">${formattedTime}</h6>
                                <small class="text-muted">${slot.start} - ${slot.end}</small>
                            `;
                            
                            card.appendChild(cardBody);
                            col.appendChild(card);
                            timeSlotsContainer.appendChild(col);
                            
                            // Add click event to select time slot
                            card.addEventListener('click', function() {
                                // Remove selected class from all time slots
                                document.querySelectorAll('.time-slot-card').forEach(el => {
                                    el.classList.remove('selected');
                                });
                                
                                // Add selected class to clicked time slot
                                this.classList.add('selected');
                                
                                // Update hidden time input
                                timeInput.value = this.dataset.time;
                                
                                // Check if all required fields are filled
                                checkRequiredFields();
                            });
                        });
                    } else {
                        timeSlotsContainer.innerHTML = `
                            <div class="col-12">
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle me-2"></i> 
                                    ${data.message || 'No available time slots for the selected date and duration.'}
                                </div>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    timeSlotsContainer.innerHTML = `
                        <div class="col-12">
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i> 
                                An error occurred while loading time slots. Please try again.
                            </div>
                        </div>
                    `;
                });
        }
        
        // Function to check and load time slots if date and duration are selected
        function checkAndLoadTimeSlots() {
            const date = dateInput.value;
            const duration = document.querySelector('input[name="duration"]:checked')?.value;
            
            // Reset time selection when date or duration changes
            timeInput.value = '';
            document.querySelectorAll('.time-slot-card').forEach(el => {
                el.classList.remove('selected');
            });
            
            if (date && duration) {
                loadTimeSlots(date, duration);
            } else {
                timeSlotsContainer.innerHTML = `
                    <div class="col-12">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i> 
                            Please select both a date and duration to see available time slots.
                        </div>
                    </div>
                `;
            }
            
            // Check if all required fields are filled
            checkRequiredFields();
        }
        
        // Check availability when form is submitted
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const date = dateInput.value;
            const time = timeInput.value;
            const duration = document.querySelector('input[name="duration"]:checked')?.value;
            
            if (!date || !time || !duration) {
                alert('Please fill in all required fields');
                return;
            }
            
            // Show loading state
            bookButton.disabled = true;
            bookButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Booking...';
            
            // Check availability one more time before submitting
            fetch(`{{ route('appointments.check-availability', $professional->id) }}?date=${date}&time=${time}&duration=${duration}`)
                .then(response => response.json())
                .then(data => {
                    if (data.available) {
                        form.submit();
                    } else {
                        alert(data.message || 'Selected time slot is not available');
                        bookButton.disabled = false;
                        bookButton.innerHTML = '<i class="fas fa-calendar-check me-2"></i> Book Appointment';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while checking availability');
                    bookButton.disabled = false;
                    bookButton.innerHTML = '<i class="fas fa-calendar-check me-2"></i> Book Appointment';
                });
        });

        // Add coupon code clear functionality
        const couponInput = document.getElementById('coupon_code');
        const clearCouponBtn = document.getElementById('clearCoupon');
        
        clearCouponBtn.addEventListener('click', function() {
            couponInput.value = '';
        });
    });
</script>
@endpush
@endsection