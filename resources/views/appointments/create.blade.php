@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center pt-5">
        <div class="col-md-8 py-5">
            <!-- Promotional Banner -->
            <div class="card shadow mb-4 border-success">
                <div class="card-body bg-success bg-opacity-10">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-gift fa-2x text-success"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h4 class="text-success mb-1">Special Offer: 100% Free First Session!</h4>
                            <p class="mb-0">Use code <strong class="text-success">WELCOME100</strong> to get your first session completely free. Limited time offer!</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Book Appointment with {{ $professional->first_name }} {{ $professional->last_name }}</h4>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <h5>Professional Details</h5>
                        <p><strong>Specialization:</strong> {{ $professional->specialization }}</p>
                        <p><strong>Qualification:</strong> {{ $professional->qualification }}</p>
                        <p><strong>License Number:</strong> {{ $professional->license_number }}</p>
                    </div>

                    <form method="POST" action="{{ route('client.appointments.store', $professional->id) }}" id="appointmentForm">
                        @csrf

                        <div class="mb-3">
                            <label for="date" class="form-label">Appointment Date</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" 
                                id="date" name="date" min="{{ date('Y-m-d') }}" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="time" class="form-label">Appointment Time</label>
                            <input type="time" class="form-control @error('time') is-invalid @enderror" 
                                id="time" name="time" required>
                            @error('time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="duration" class="form-label">Session Duration (minutes)</label>
                            <select class="form-select @error('duration') is-invalid @enderror" id="duration" name="duration" required>
                                <option value="">Select Duration</option>
                                @if($settings && isset($settings->session_durations))
                                    @foreach($settings->session_durations as $duration)
                                        <option value="{{ $duration }}">{{ $duration }} minutes</option>
                                    @endforeach
                                @else
                                    <option value="30">30 minutes</option>
                                    <option value="60">60 minutes</option>
                                    <option value="90">90 minutes</option>
                                @endif
                            </select>
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="coupon_code" class="form-label">Coupon Code</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-lg @error('coupon_code') is-invalid @enderror" 
                                    id="coupon_code" name="coupon_code" value="WELCOME100">
                                <button class="btn btn-outline-secondary" type="button" id="clearCoupon">
                                    <i class="fas fa-times"></i> Clear
                                </button>
                            </div>
                            <small class="text-muted mt-2">
                                <i class="fas fa-info-circle"></i> Default coupon "WELCOME100" gives you 100% discount on your first session!
                            </small>
                            @error('coupon_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Additional Notes (Optional)</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                id="notes" name="notes" rows="3"></textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Book Appointment</button>
                            <a href="{{ route('client.appointments') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('date');
        const timeInput = document.getElementById('time');
        const durationSelect = document.getElementById('duration');
        const form = document.getElementById('appointmentForm');
        
        // Set min date to today
        const today = new Date();
        const yyyy = today.getFullYear();
        let mm = today.getMonth() + 1;
        let dd = today.getDate();
        
        if (mm < 10) mm = '0' + mm;
        if (dd < 10) dd = '0' + dd;
        
        const formattedToday = yyyy + '-' + mm + '-' + dd;
        dateInput.min = formattedToday;
        
        // Check availability when form is submitted
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const date = dateInput.value;
            const time = timeInput.value;
            const duration = durationSelect.value;
            
            if (!date || !time || !duration) {
                alert('Please fill in all required fields');
                return;
            }
            
            // Check availability
            fetch(`{{ route('appointments.check-availability', $professional->id) }}?date=${date}&time=${time}&duration=${duration}`)
                .then(response => response.json())
                .then(data => {
                    if (data.available) {
                        form.submit();
                    } else {
                        alert(data.message || 'Selected time slot is not available');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while checking availability');
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