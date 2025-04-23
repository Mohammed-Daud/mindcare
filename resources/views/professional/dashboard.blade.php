@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center pt-5">
        <div class="col-md-8 py-5">
            <div class="card">
                <div class="card-header">{{ __('Professional Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center">
                                <img src="{{ $professional->profile_photo_url ?? asset('images/default-avatar.png') }}" 
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
                                Edit Profile
                            </a>
                            <a href="{{ route('professional.settings.edit') }}" class="btn btn-secondary">
                                Manage Availability
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 