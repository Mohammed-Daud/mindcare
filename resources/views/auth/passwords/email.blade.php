<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | MindCare Professional Counseling</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .auth-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 150px;
        }
        .auth-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        .btn-primary {
            width: 100%;
            padding: 12px;
            background-color: #4a6cf7;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #3a5ce5;
        }
        .auth-links {
            margin-top: 20px;
            text-align: center;
        }
        .auth-links a {
            color: #4a6cf7;
            text-decoration: none;
        }
        .auth-links a:hover {
            text-decoration: underline;
        }
        .error-message {
            color: #dc3545;
            margin-top: 5px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    @include('partials.header')
    
    <div class="container my-5">
        <div class="auth-container">
            <h2 class="auth-title">Reset Password</h2>
            
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            
            <form method="POST" action="{{ url('/password/email') }}">
                @csrf
                <input type="hidden" name="user_type" value="{{ request()->query('usertype', 'user') }}">
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="error-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <button type="submit" class="btn-primary">
                    Send Password Reset Link
                </button>
            </form>
            
            <div class="auth-links">
                @php
                    $userType = request()->query('usertype', 'user');
                    $loginRoute = match($userType) {
                        'professional' => 'professional.login',
                        'client' => 'client.login',
                        'admin' => 'admin.login',
                        default => 'login'
                    };
                @endphp
                <a href="{{ route($loginRoute) }}">
                    Back to Login
                </a>
                <br>
                <!-- <a href="{{ route('password.direct') }}" style="color: #dc3545;">
                    Try Direct Password Reset (No Email)
                </a> -->
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    @include('partials.footer')
</body>
</html> 