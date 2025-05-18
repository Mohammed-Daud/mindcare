@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center pt-5">
        <div class="col-md-8 py-5">
            <div class="card">
                <div class="card-header" style="background-color: var(--primary); color: white;">{{ __('Edit Profile') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('professional.profile.update') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">{{ __('First Name') }}</label>
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name', $professional->first_name) }}" required autocomplete="first_name" autofocus>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="last_name" class="form-label">{{ __('Last Name') }}</label>
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name', $professional->last_name) }}" required autocomplete="last_name">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="phone" class="form-label">{{ __('Phone Number') }}</label>
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $professional->phone) }}" autocomplete="phone">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="specialization" class="form-label">{{ __('Specialization') }}</label>
                                <input id="specialization" type="text" class="form-control @error('specialization') is-invalid @enderror" name="specialization" value="{{ old('specialization', $professional->specialization) }}" autocomplete="specialization">
                                @error('specialization')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="qualification" class="form-label">{{ __('Qualification') }}</label>
                                <input id="qualification" type="text" class="form-control @error('qualification') is-invalid @enderror" name="qualification" value="{{ old('qualification', $professional->qualification) }}" autocomplete="qualification">
                                @error('qualification')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="license_number" class="form-label">{{ __('License Number') }}</label>
                                <input id="license_number" type="text" class="form-control @error('license_number') is-invalid @enderror" name="license_number" value="{{ old('license_number', $professional->license_number) }}" autocomplete="license_number">
                                @error('license_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="license_expiry_date" class="form-label">{{ __('License Expiry Date') }}</label>
                                <input id="license_expiry_date" type="date" class="form-control @error('license_expiry_date') is-invalid @enderror" name="license_expiry_date" value="{{ old('license_expiry_date', $professional->license_expiry_date ? $professional->license_expiry_date->format('Y-m-d') : '') }}" autocomplete="license_expiry_date">
                                @error('license_expiry_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="profile_photo" class="form-label">{{ __('Profile Photo') }}</label>
                                <div class="profile-photo-container mb-2">
                                    @if($professional->profile_photo)
                                        <img src="{{ asset('storage/' . $professional->profile_photo) }}" 
                                             alt="Profile Photo" 
                                             class="profile-photo-preview img-thumbnail"
                                             style="max-width: 150px; height: auto;">
                                    @else
                                        <div class="no-photo-placeholder" style="width: 150px; height: 150px; background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; border: 1px solid #dee2e6; border-radius: 4px;">
                                            <i class="fas fa-user" style="font-size: 48px; color: #6c757d;"></i>
                                        </div>
                                    @endif
                                </div>
                                <input id="profile_photo" type="file" class="form-control @error('profile_photo') is-invalid @enderror" name="profile_photo" accept="image/*" onchange="previewImage(this);">
                                @error('profile_photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if($professional->profile_photo)
                                    <small class="form-text text-muted">Current photo will be replaced if a new one is uploaded.</small>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="cv" class="form-label">{{ __('CV/Resume') }}</label>
                                <input id="cv" type="file" class="form-control @error('cv') is-invalid @enderror" name="cv" accept=".pdf,.doc,.docx">
                                @error('cv')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if($professional->cv)
                                    <div class="mt-2">
                                        <a href="{{ asset('storage/' . $professional->cv) }}" class="btn btn-sm btn-info" target="_blank">
                                            <i class="fas fa-download"></i> Download Current CV
                                        </a>
                                        <small class="form-text text-muted">Current CV will be replaced if a new one is uploaded.</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="bio" class="form-label">{{ __('Professional Bio') }}</label>
                                <textarea id="bio" class="form-control @error('bio') is-invalid @enderror" name="bio" rows="4" autocomplete="bio">{{ old('bio', $professional->bio) }}</textarea>
                                @error('bio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Profile') }}
                                </button>
                                <a href="{{ route('professional.dashboard') }}" class="btn btn-secondary">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>

                    <hr class="my-4">

                    <div class="card">
                        <div class="card-header" style="background-color: var(--primary); color: white;">{{ __('Change Password') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('professional.profile.password') }}">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
                                        <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>
                                        @error('current_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="password" class="form-label">{{ __('New Password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="password_confirmation" class="form-label">{{ __('Confirm New Password') }}</label>
                                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Change Password') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var preview = document.querySelector('.profile-photo-preview');
            if (preview) {
                preview.src = e.target.result;
            } else {
                var container = document.querySelector('.profile-photo-container');
                container.innerHTML = `<img src="${e.target.result}" alt="Profile Photo Preview" class="profile-photo-preview img-thumbnail" style="max-width: 150px; height: auto;">`;
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush 