@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: var(--primary); color: white;">{{ __('Professional Profile') }}</div>

                <div class="card-body">
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
                                <div class="col-md-4"><strong>Qualification:</strong></div>
                                <div class="col-md-8">{{ $professional->qualification }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>License Number:</strong></div>
                                <div class="col-md-8">{{ $professional->license_number }}</div>
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
                            <a href="#" class="btn btn-primary">
                                Book Session
                            </a>
                            <a href="{{ route('professionals') }}" class="btn btn-secondary">
                                Back to Professionals
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 