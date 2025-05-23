@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center py-5">
        <div class="col-md-8 py-5">
            <div class="card shadow">
                <div class="card-header" style="background-color: var(--primary); color: white;">
                    <h4 class="mb-0">Client Login</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('message'))
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i> {{ session('message') }}
                        </div>
                    @endif
                    
                    @if(session('redirect_url'))
                        <input type="hidden" name="redirect_url" value="{{ session('redirect_url') }}">
                    @endif

                    <form method="POST" action="{{ route('client.login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                id="email" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Login</button>
                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('password.request', ['usertype' => 'client']) }}" class="btn btn-primary">
                                    Forgot Your Password?
                                </a>
                                <a href="{{ route('client.register') }}" class="btn btn-primary">
                                    Don't have an account? Register
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 