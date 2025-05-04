@extends('layouts.app')

@section('content')
<div class="container py-3 py-md-5">
    <div class="row">
        <div class="col-12 pt-3 pt-md-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                <div>
                    <h2 class="mb-0 fw-bold text-primary">My Appointments</h2>
                    <p class="text-muted mb-0 d-none d-md-block">Manage your therapy sessions and consultations</p>
                </div>
                <a href="{{ route('professionals') }}" class="btn btn-primary btn-lg shadow-sm">
                    <i class="fas fa-plus-circle me-2"></i> Book New Appointment
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

            @if($appointments->count() > 0)
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card shadow rounded-3 border-0 overflow-hidden">
                            <div class="card-header bg-gradient-primary text-white py-3">
                                <h5 class="mb-0 fw-bold"><i class="fas fa-calendar-check me-2"></i> Upcoming Appointments</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="list-group list-group-flush">
                                    @php
                                        $upcomingFound = false;
                                    @endphp
                                    
                                    @foreach($appointments as $appointment)
                                        @if($appointment->status === 'confirmed' && $appointment->start_time->isFuture())
                                            @php
                                                $upcomingFound = true;
                                                $timeRemaining = now()->diffForHumans($appointment->start_time, ['parts' => 2]);
                                                $daysRemaining = now()->diffInDays($appointment->start_time);
                                                $isToday = now()->isSameDay($appointment->start_time);
                                                $isTomorrow = now()->addDay()->isSameDay($appointment->start_time);
                                            @endphp
                                            
                                            <a href="{{ route('client.appointments.show', $appointment) }}" class="list-group-item list-group-item-action p-3 p-md-4 appointment-item">
                                                <div class="row align-items-center">
                                                    <div class="col-12 col-md-1 mb-3 mb-md-0 text-center">
                                                        <div class="avatar-circle bg-gradient-primary text-white mx-auto">
                                                            <span>{{ substr($appointment->professional->first_name, 0, 1) }}{{ substr($appointment->professional->last_name, 0, 1) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                                                        <h5 class="mb-1 fw-bold text-primary">{{ $appointment->professional->first_name }} {{ $appointment->professional->last_name }}</h5>
                                                        <p class="mb-0 text-muted">
                                                            <i class="fas fa-user-md me-1 small"></i> 
                                                            {{ $appointment->professional->specialization }}
                                                        </p>
                                                    </div>
                                                    <div class="col-6 col-md-3 mb-3 mb-md-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="icon-circle bg-light text-primary me-3">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bold">{{ $appointment->start_time->format('D, M d, Y') }}</div>
                                                                <div class="small text-muted">
                                                                    <i class="far fa-clock me-1"></i>
                                                                    {{ $appointment->start_time->format('g:i A') }} - {{ $appointment->end_time->format('g:i A') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-2 mb-3 mb-md-0">
                                                        <div class="text-center px-2 py-2 rounded-3 
                                                            @if($isToday) bg-danger bg-opacity-10 text-danger
                                                            @elseif($isTomorrow) bg-warning bg-opacity-10 text-warning
                                                            @else bg-info bg-opacity-10 text-info
                                                            @endif">
                                                            <div class="fw-bold">
                                                                @if($isToday)
                                                                    <i class="fas fa-exclamation-circle me-1"></i> Today
                                                                @elseif($isTomorrow)
                                                                    <i class="fas fa-clock me-1"></i> Tomorrow
                                                                @else
                                                                    <i class="fas fa-calendar-day me-1"></i> In {{ $daysRemaining }} days
                                                                @endif
                                                            </div>
                                                            <div class="small mt-1">{{ $timeRemaining }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-2 text-center text-md-end mt-3 mt-md-0">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rescheduleModal{{ $appointment->id }}">
                                                                <i class="fas fa-calendar-alt me-md-2"></i><span class="d-none d-md-inline">Reschedule</span>
                                                            </button>
                                                            <a href="{{ route('client.appointments.show', $appointment) }}" class="btn btn-info text-white">
                                                                <i class="fas fa-eye me-md-2"></i><span class="d-none d-md-inline">Details</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endif
                                    @endforeach
                                    
                                    @if(!$upcomingFound)
                                        <div class="text-center py-5">
                                            <div class="empty-state-container">
                                                <div class="empty-state-icon bg-light text-primary rounded-circle mb-4">
                                                    <i class="far fa-calendar-alt fa-3x"></i>
                                                </div>
                                                <h4 class="fw-bold text-primary">No Upcoming Appointments</h4>
                                                <p class="text-muted mb-4 mx-auto" style="max-width: 500px;">
                                                    You don't have any upcoming appointments scheduled. Book a session with one of our professionals to get started on your wellness journey.
                                                </p>
                                                <a href="{{ route('professionals') }}" class="btn btn-primary btn-lg px-4 shadow-sm">
                                                    <i class="fas fa-plus-circle me-2"></i> Book an Appointment
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card shadow rounded-3 border-0 overflow-hidden mt-4">
                    <div class="card-header bg-gradient-secondary text-white py-3">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-history me-2"></i> All Appointments</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover appointment-table mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="ps-4">Professional</th>
                                        <th>Date & Time</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                        <tr class="{{ $appointment->status === 'confirmed' && $appointment->start_time->isFuture() ? 'table-primary' : ($appointment->status === 'cancelled' ? 'table-danger bg-opacity-10' : '') }}">
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle-sm bg-gradient-primary text-white me-3">
                                                        <span>{{ substr($appointment->professional->first_name, 0, 1) }}{{ substr($appointment->professional->last_name, 0, 1) }}</span>
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold">{{ $appointment->professional->first_name }} {{ $appointment->professional->last_name }}</div>
                                                        <small class="text-muted">{{ $appointment->professional->specialization }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="fw-bold">{{ $appointment->start_time->format('M d, Y') }}</div>
                                                <div class="small text-muted">
                                                    <i class="far fa-clock me-1"></i>
                                                    {{ $appointment->start_time->format('g:i A') }} - 
                                                    {{ $appointment->end_time->format('g:i A') }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-circle-sm bg-light text-primary me-2">
                                                        <i class="fas fa-hourglass-half"></i>
                                                    </div>
                                                    <span class="fw-bold">{{ $appointment->duration }} min</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge rounded-pill px-3 py-2 bg-{{ $appointment->status === 'confirmed' ? 'success' : ($appointment->status === 'cancelled' ? 'danger' : 'warning') }}">
                                                    <i class="fas fa-{{ $appointment->status === 'confirmed' ? 'check-circle' : ($appointment->status === 'cancelled' ? 'times-circle' : 'exclamation-circle') }} me-1"></i>
                                                    {{ ucfirst($appointment->status) }}
                                                </span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="btn-group">
                                                    <a href="{{ route('client.appointments.show', $appointment) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-eye me-1"></i> View
                                                    </a>
                                                    
                                                    @if($appointment->status === 'confirmed' && $appointment->start_time->isFuture())
                                                        <button type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#rescheduleModal{{ $appointment->id }}">
                                                            <i class="fas fa-calendar-alt me-1"></i> Reschedule
                                                        </button>
                                                        <form action="{{ route('client.appointments.cancel', $appointment) }}" 
                                                              method="POST" 
                                                              class="d-inline"
                                                              onsubmit="return confirm('Are you sure you want to cancel this appointment?');">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-times me-1"></i> Cancel
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-light py-3">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                            <div>
                                <span class="badge bg-primary rounded-pill px-3 py-2">
                                    <i class="fas fa-calendar-check me-1"></i>
                                    Showing {{ $appointments->firstItem() ?? 0 }} to {{ $appointments->lastItem() ?? 0 }} of {{ $appointments->total() }} appointments
                                </span>
                            </div>
                            <div class="pagination-container">
                                {{ $appointments->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card shadow rounded-3 border-0 overflow-hidden">
                    <div class="card-body text-center py-5">
                        <div class="empty-state-container py-4">
                            <div class="empty-state-icon bg-light text-primary rounded-circle mb-4 mx-auto">
                                <i class="fas fa-calendar-times fa-4x"></i>
                            </div>
                            <h3 class="fw-bold text-primary mb-3">No Appointments Found</h3>
                            <p class="text-muted mb-4 mx-auto" style="max-width: 500px;">
                                You haven't booked any appointments yet. Start your wellness journey by booking a session with one of our qualified professionals.
                            </p>
                            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                                <a href="{{ route('professionals') }}" class="btn btn-primary btn-lg px-4 gap-3 shadow-sm">
                                    <i class="fas fa-search me-2"></i> Browse Professionals
                                </a>
                                <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-lg px-4">
                                    <i class="fas fa-home me-2"></i> Return Home
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Reschedule Modals -->
            @foreach($appointments as $appointment)
                @if($appointment->status === 'confirmed' && $appointment->start_time->isFuture())
                    <div class="modal fade" id="rescheduleModal{{ $appointment->id }}" tabindex="-1" aria-labelledby="rescheduleModalLabel{{ $appointment->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="rescheduleModalLabel{{ $appointment->id }}">
                                        <i class="fas fa-calendar-alt me-2"></i> Reschedule Appointment
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                        <button type="button" class="btn btn-primary reschedule-submit">
                                            <i class="fas fa-calendar-check me-2"></i> Reschedule
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>



  

@push('scripts')
<style>
    .avatar-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
    
    .avatar-circle-sm {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.8rem;
    }
    
    .list-group-item:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }
    
    @media (max-width: 767.98px) {
        .table-responsive {
            font-size: 0.9rem;
        }
        
        .btn-group-sm > .btn {
            padding: 0.25rem 0.4rem;
        }
    }
</style>

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
                        /* Gradient backgrounds */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    }
    
    .bg-gradient-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    }
    
    /* Avatar styles */
    .avatar-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }
    
    .avatar-circle:hover {
        transform: scale(1.05);
    }
    
    .avatar-circle-sm {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.9rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    /* Icon circles */
    .icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }
    
    .icon-circle-sm {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
    }
    
    /* Empty state styling */
    .empty-state-container {
        padding: 2rem 1rem;
    }
    
    .empty-state-icon {
        width: 120px;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    
    /* List group item styling */
    .appointment-item {
        transition: all 0.2s ease;
        border-left: 4px solid transparent;
    }
    
    .appointment-item:hover {
        background-color: rgba(13, 110, 253, 0.05);
        border-left: 4px solid #0d6efd;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    
    /* Table styling */
    .appointment-table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
    
    .appointment-table td {
        vertical-align: middle;
        padding-top: 1rem;
        padding-bottom: 1rem;
    }
    
    /* Button styling */
    .btn {
        border-radius: 0.375rem;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .btn-primary, .btn-info, .btn-danger {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    /* Badge styling */
    .badge {
        font-weight: 500;
        letter-spacing: 0.5px;
    }
    
    /* Pagination styling */
    .pagination-container .pagination {
        margin-bottom: 0;
    }
    
    .pagination-container .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    
    .pagination-container .page-link {
        color: #0d6efd;
        padding: 0.5rem 0.75rem;
        border-radius: 0.25rem;
        margin: 0 0.125rem;
    }
    
    /* Responsive adjustments */
    @media (max-width: 767.98px) {
        .table-responsive {
            font-size: 0.9rem;
        }
        
        .btn-group > .btn {
            padding: 0.375rem 0.5rem;
        }
        
        .avatar-circle {
            width: 50px;
            height: 50px;
        }
        
        .empty-state-icon {
            width: 100px;
            height: 100px}
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
@endsection