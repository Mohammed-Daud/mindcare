@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12 pt-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">My Appointments</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($appointments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Professional</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                        <tr>
                                            <td>
                                                {{ $appointment->professional->first_name }} 
                                                {{ $appointment->professional->last_name }}
                                            </td>
                                            <td>{{ $appointment->start_time->format('M d, Y') }}</td>
                                            <td>
                                                {{ $appointment->start_time->format('g:i A') }} - 
                                                {{ $appointment->end_time->format('g:i A') }}
                                            </td>
                                            <td>{{ $appointment->duration }} minutes</td>
                                            <td>
                                                <span class="badge bg-{{ $appointment->status === 'confirmed' ? 'success' : ($appointment->status === 'cancelled' ? 'danger' : 'warning') }}">
                                                    {{ ucfirst($appointment->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($appointment->status === 'confirmed' && $appointment->start_time->isFuture())
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#rescheduleModal{{ $appointment->id }}">
                                                            Reschedule
                                                        </button>
                                                        <form action="{{ route('client.appointments.cancel', $appointment) }}" 
                                                              method="POST" 
                                                              class="d-inline"
                                                              onsubmit="return confirm('Are you sure you want to cancel this appointment?');">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                Cancel
                                                            </button>
                                                        </form>
                                                    </div>

                                                    <!-- Reschedule Modal -->
                                                    <div class="modal fade" id="rescheduleModal{{ $appointment->id }}" tabindex="-1" aria-labelledby="rescheduleModalLabel{{ $appointment->id }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="rescheduleModalLabel{{ $appointment->id }}">Reschedule Appointment</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form id="rescheduleForm{{ $appointment->id }}" 
                                                                      class="reschedule-form"
                                                                      action="{{ route('client.appointments.reschedule', $appointment) }}"
                                                                      data-professional-id="{{ $appointment->professional->id }}"
                                                                      data-duration="{{ $appointment->duration }}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="date{{ $appointment->id }}" class="form-label">New Date</label>
                                                                            <input type="date" class="form-control" id="date{{ $appointment->id }}" name="date" required min="{{ date('Y-m-d') }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="time{{ $appointment->id }}" class="form-label">New Time</label>
                                                                            <input type="time" class="form-control" id="time{{ $appointment->id }}" name="time" required>
                                                                        </div>
                                                                        <div id="availabilityMessage{{ $appointment->id }}" class="alert" style="display: none;"></div>
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
                                                                        <button type="button" class="btn btn-primary reschedule-submit">Reschedule</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $appointments->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <h5>No Appointments Found</h5>
                            <p class="text-muted">You haven't booked any appointments yet.</p>
                            <a href="{{ route('professionals') }}" class="btn btn-primary">
                                Browse Professionals
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing reschedule forms');
    
    // Handle reschedule form submissions
    const rescheduleForms = document.querySelectorAll('.reschedule-form');
    console.log('Found reschedule forms:', rescheduleForms.length);
    
    rescheduleForms.forEach(form => {
        console.log('Setting up form:', form.id);
        
        // Add click event listener to the submit button
        const submitButton = form.querySelector('.reschedule-submit');
        submitButton.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Submit button clicked:', form.id);
            
            const appointmentId = form.id.replace('rescheduleForm', '');
            const dateInput = document.getElementById(`date${appointmentId}`);
            const timeInput = document.getElementById(`time${appointmentId}`);
            const availabilityMessage = document.getElementById(`availabilityMessage${appointmentId}`);
            const originalButtonText = this.innerHTML;
            
            // Validate inputs
            if (!dateInput.value || !timeInput.value) {
                availabilityMessage.textContent = 'Please select both date and time.';
                availabilityMessage.className = 'alert alert-danger';
                availabilityMessage.style.display = 'block';
                return;
            }
            
            console.log('Form data:', {
                date: dateInput.value,
                time: timeInput.value,
                duration: form.dataset.duration,
                professionalId: form.dataset.professionalId
            });
            
            // Show loading state
            this.disabled = true;
            this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Checking availability...';
            availabilityMessage.style.display = 'none';
            
            // Check availability first
            fetch(`/appointments/check-availability/${form.dataset.professionalId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    date: dateInput.value,
                    time: timeInput.value,
                    duration: form.dataset.duration
                })
            })
            .then(response => {
                console.log('Availability check response:', response);
                return response.json();
            })
            .then(data => {
                console.log('Availability check data:', data);
                if (data.available) {
                    // Update button text for rescheduling
                    this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Rescheduling...';
                    
                    // If available, submit the reschedule request
                    fetch(form.action, {
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
                        console.log('Reschedule response:', response);
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Reschedule data:', data);
                        if (data.success) {
                            // Show success message
                            availabilityMessage.textContent = data.message;
                            availabilityMessage.className = 'alert alert-success';
                            availabilityMessage.style.display = 'block';
                            
                            // Close modal after a short delay
                            setTimeout(() => {
                                const modal = document.getElementById(`rescheduleModal${appointmentId}`);
                                const modalInstance = bootstrap.Modal.getInstance(modal);
                                if (modalInstance) {
                                    modalInstance.hide();
                                }
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
        const appointmentId = form.id.replace('rescheduleForm', '');
        const dateInput = document.getElementById(`date${appointmentId}`);
        const timeInput = document.getElementById(`time${appointmentId}`);
        const availabilityMessage = document.getElementById(`availabilityMessage${appointmentId}`);
        
        // Check availability when date or time changes
        const checkAvailability = () => {
            if (dateInput.value && timeInput.value) {
                console.log('Checking availability for:', {
                    date: dateInput.value,
                    time: timeInput.value,
                    duration: form.dataset.duration
                });
                
                availabilityMessage.style.display = 'none';
                
                fetch(`/appointments/check-availability/${form.dataset.professionalId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        date: dateInput.value,
                        time: timeInput.value,
                        duration: form.dataset.duration
                    })
                })
                .then(response => {
                    console.log('Availability check response:', response);
                    return response.json();
                })
                .then(data => {
                    console.log('Availability check data:', data);
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
    });
});
</script>
@endpush 