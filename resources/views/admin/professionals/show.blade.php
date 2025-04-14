@extends('admin.layouts.app')

@section('title', 'Professional Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.professionals.index') }}">Professionals</a></li>
    <li class="breadcrumb-item active">Details</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Professional Details</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.professionals.edit', $professional) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.professionals.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($professional->profile_photo)
                                <img src="{{ asset('storage/' . $professional->profile_photo) }}" 
                                     alt="Profile Photo" 
                                     class="img-fluid rounded-circle mb-3"
                                     style="max-width: 200px;">
                            @else
                                <div class="text-center mb-3">
                                    <i class="fas fa-user-circle fa-6x text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h4>{{ $professional->first_name }} {{ $professional->last_name }}</h4>
                            <p class="text-muted">{{ $professional->specialization }}</p>
                            
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h5>Contact Information</h5>
                                    <p><strong>Email:</strong> {{ $professional->email }}</p>
                                    <p><strong>Phone:</strong> {{ $professional->phone }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Professional Information</h5>
                                    <p><strong>Qualification:</strong> {{ $professional->qualification }}</p>
                                    <p><strong>License Number:</strong> {{ $professional->license_number }}</p>
                                    <p><strong>License Expiry:</strong> {{ $professional->license_expiry_date->format('M d, Y') }}</p>
                                    <p>
                                        <strong>Status:</strong>
                                        <span class="badge badge-{{ $professional->status === 'approved' ? 'success' : ($professional->status === 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($professional->status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <h5>Professional Bio</h5>
                                    <p>{{ $professional->bio }}</p>
                                </div>
                            </div>

                            @if($professional->cv)
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <h5>CV/Resume</h5>
                                        <a href="{{ asset('storage/' . $professional->cv) }}" 
                                           class="btn btn-info btn-sm" 
                                           target="_blank">
                                            <i class="fas fa-file-pdf"></i> View CV
                                        </a>
                                    </div>
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