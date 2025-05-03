@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Professional Profile') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
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
                                <div class="col-md-4"><strong>Qualification:</strong></div>
                                <div class="col-md-8">{{ $professional->qualification }}</div>
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
                            <a href="{{ route('professional.profile.edit') }}" class="btn btn-primary">
                                Edit Profile
                            </a>
                            <a href="{{ route('professional.dashboard') }}" class="btn btn-secondary">
                                Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 