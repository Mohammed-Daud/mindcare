<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | MindCare Professional Counseling</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .admin-login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .admin-login-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 24px;
        }
        .admin-login-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .admin-login-logo img {
            max-width: 150px;
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
        .btn-admin {
            width: 100%;
            padding: 12px;
            background-color: #343a40;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-admin:hover {
            background-color: #212529;
        }
        .error-message {
            color: #dc3545;
            margin-top: 5px;
            font-size: 14px;
        }
        .back-to-site {
            text-align: center;
            margin-top: 20px;
        }
        .back-to-site a {
            color: #6c757d;
            text-decoration: none;
        }
        .back-to-site a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="admin-login-container">
        <div class="admin-login-logo">
            <h1>MindCare Admin</h1>
        </div>
        
        <h2 class="admin-login-title">Admin Login</h2>
        
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <button type="submit" class="btn-admin">
                Login
            </button>
            
            <div class="auth-links mt-3 text-center">
                <a href="{{ route('password.request', ['usertype' => 'admin']) }}">
                    Forgot Your Password?
                </a>
            </div>
        </form>
        
        <div class="back-to-site">
            <a href="{{ route('home') }}">
                <i class="fas fa-arrow-left"></i> Back to Main Site
            </a>
        </div>
    </div>
</body>
</html> 