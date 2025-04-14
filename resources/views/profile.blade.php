@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container profile-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        @if($professional->profile_photo)
                            <img src="{{ asset('storage/' . $professional->profile_photo) }}" alt="{{ $professional->full_name }}" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
                        <h2 class="card-title">{{ $professional->full_name }}</h2>
                        <p class="text-muted">{{ $professional->specialization }}</p>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Email:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $professional->email }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Phone:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $professional->phone }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>License Number:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $professional->license_number }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>License Expiry:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $professional->license_expiry_date->format('F d, Y') }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Qualification:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $professional->qualification }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Professional Bio:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $professional->bio }}
                        </div>
                    </div>

                    @if($professional->cv_path)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>CV/Resume:</strong>
                        </div>
                        <div class="col-md-8">
                            <a href="{{ asset('storage/' . $professional->cv_path) }}" class="btn btn-primary btn-sm" target="_blank">
                                <i class="fas fa-download"></i> Download CV
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection