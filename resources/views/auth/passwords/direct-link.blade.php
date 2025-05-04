<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Link | MindCare Professional Counseling</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .auth-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .auth-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        .reset-link {
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 4px;
            word-break: break-all;
            margin-bottom: 20px;
        }
        .btn-primary {
            display: inline-block;
            padding: 12px 24px;
            background-color: #4a6cf7;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
            margin-top: 20px;
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
        .info-box {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            border-radius: 4px;
            color: #0c5460;
        }
        .direct-reset-form {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
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
    
    <div class="container">
        <div class="auth-container">
            <h2 class="auth-title">Password Reset Link</h2>
            
            <div class="info-box">
                <p><strong>Account Type:</strong> {{ ucfirst($userType) }}</p>
                <p><strong>Email:</strong> {{ $email }}</p>
            </div>
            
            <p>Here is your password reset link. Click the button below or copy the link:</p>
            
            <div class="reset-link">
                {{ $resetUrl }}
            </div>
            
            <div style="text-align: center;">
                <a href="{{ $resetUrl }}" class="btn-primary">Reset Password</a>
            </div>
            
            <div class="direct-reset-form">
                <h3>Or Reset Password Directly</h3>
                <p>You can also reset your password directly using the form below:</p>
                
                <form method="POST" action="{{ route('password.direct.reset') }}">
                    @csrf
                    
                    <input type="hidden" name="email" value="{{ $email }}">
                    
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="password-confirm">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    
                    <button type="submit" class="btn-primary" style="width: 100%;">
                        Reset Password
                    </button>
                </form>
            </div>
            
            <div class="auth-links">
                <a href="{{ route('login') }}">
                    Back to Login
                </a>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    @include('partials.footer')
</body>
</html>