@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center pt-5">
        <div class="col-md-8 py-5">
            <div class="card">
                <div class="card-header" style="background-color: var(--primary); color: white;">{{ __('Professional Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center">
                                <img src="{{ $professional->profile_photo_url }}" 
                                     class="rounded-circle mb-3" 
                                     style="width: 150px; height: 150px; object-fit: cover;">
                                <h4>{{ $professional->first_name }} {{ $professional->last_name }}</h4>
                                <p class="text-muted">{{ $professional->specialization }}</p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h5>Professional Information</h5>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Email:</strong></div>
                                <div class="col-md-8">{{ $professional->email }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Phone:</strong></div>
                                <div class="col-md-8">{{ $professional->phone }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>License Number:</strong></div>
                                <div class="col-md-8">{{ $professional->license_number }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>License Expiry:</strong></div>
                                <div class="col-md-8">{{ $professional->license_expiry_date }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Status:</strong></div>
                                <div class="col-md-8">
                                    <span class="badge {{ $professional->status === 'approved' ? 'bg-success' : 'bg-warning' }}">
                                        {{ ucfirst($professional->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Professional Bio</h5>
                            <hr>
                            <p>{{ $professional->bio }}</p>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <a href="{{ route('professional.profile.edit') }}" class="btn btn-primary me-2">
                                <i class="fas fa-user-edit me-1"></i> Edit Profile
                            </a>
                            <a href="{{ route('professional.settings.edit') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-cog me-1"></i> Manage Availability
                            </a>
                            <a href="{{ route('professional.appointments') }}" class="btn btn-success">
                                <i class="fas fa-calendar-check me-1"></i> My Appointments
                            </a>
                        </div>
                    </div>
                    
                    <!-- Upcoming Appointments Preview -->
                    <div class="card mt-4">
                        <div class="card-header" style="background-color: var(--primary); color: white;">
                            <i class="fas fa-calendar-alt me-2"></i>Upcoming Appointments
                        </div>
                        <div class="card-body">
                            @php
                                $upcomingAppointments = $professional->appointments()
                                    ->where('status', 'confirmed')
                                    ->where('start_time', '>', now())
                                    ->orderBy('start_time', 'asc')
                                    ->take(3)
                                    ->get();
                            @endphp
                            
                            @if($upcomingAppointments->count() > 0)
                                <div class="list-group">
                                    @foreach($upcomingAppointments as $appointment)
                                        <div class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-1">{{ $appointment->client->first_name }} {{ $appointment->client->last_name }}</h6>
                                                    <p class="mb-1 text-muted">
                                                        <i class="far fa-calendar me-1"></i> {{ $appointment->start_time->format('D, M d, Y') }}
                                                        <i class="far fa-clock ms-2 me-1"></i> {{ $appointment->start_time->format('g:i A') }} - {{ $appointment->end_time->format('g:i A') }}
                                                    </p>
                                                </div>
                                                <div class="d-flex">
                                                    <a href="{{ route('professional.appointments.show', $appointment) }}" class="btn btn-sm btn-outline-primary me-2">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                    @if($appointment->start_time->isPast() && $appointment->end_time->isFuture())
                                                        <a href="{{ route('appointments.jitsi', $appointment) }}" class="btn btn-sm btn-success">
                                                            <i class="fas fa-video"></i> Join
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="text-center mt-3">
                                    <a href="{{ route('professional.appointments') }}" class="btn btn-outline-primary">
                                        View All Appointments <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="far fa-calendar-alt fa-3x text-muted mb-3"></i>
                                    <h5>No Upcoming Appointments</h5>
                                    <p class="text-muted">You don't have any upcoming appointments scheduled.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 