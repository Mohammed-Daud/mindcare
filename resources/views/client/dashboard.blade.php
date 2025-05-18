@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row py-5">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Profile Information</h5>
                </div>
                <div class="card-body text-center">
                    @if($client->profile_photo)
                        <img src="{{ $client->profile_photo_url }}" alt="Profile Photo" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <!-- <img src="{{ asset('images/default-avatar.svg') }}" alt="Default Avatar" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;"> -->
                        <i class="fas fa-user fa-3x mb-3 text-primary"></i>
                    @endif
                    <h4>{{ $client->full_name }}</h4>
                    <p class="text-muted">{{ $client->email }}</p>
                    <p><i class="fas fa-phone"></i> {{ $client->phone }}</p>
                    <a href="{{ route('client.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header" style="background-color: var(--primary); color: white;">{{ __('Client Dashboard') }}</div>
                <div class="card-body">
                    <h4>Welcome, {{ $client->first_name }}!</h4>
                    <p>This is your client dashboard. Here you can manage your appointments, view your profile, and more.</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-calendar-check fa-3x mb-3 text-primary"></i>
                                    <h5>Appointments</h5>
                                    <p>View and manage your appointments</p>
                                    <a href="{{ route('client.appointments') }}" class="btn btn-outline-primary">View Appointments</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-user-md fa-3x mb-3 text-primary"></i>
                                    <h5>Find Professionals</h5>
                                    <p>Browse and book sessions with professionals</p>
                                    <a href="{{ route('professionals') }}" class="btn btn-outline-primary">Browse Professionals</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 