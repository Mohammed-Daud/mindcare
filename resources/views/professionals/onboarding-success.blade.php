<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Submitted | MindCare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .success-section {
            padding: 150px 0 80px;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
        }
        .success-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .success-header {
            background-color: var(--primary);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .success-header h1 {
            color: white;
            margin-bottom: 10px;
        }
        .success-body {
            padding: 40px;
            text-align: center;
        }
        .success-icon {
            font-size: 5rem;
            color: #28a745;
            margin-bottom: 1.5rem;
        }
        .success-body h3 {
            margin-bottom: 1rem;
            color: var(--secondary);
        }
        .success-body p {
            margin-bottom: 1.5rem;
            color: #555;
        }
        .alert-info {
            background-color: #e8f4fd;
            border: 1px solid #bee5eb;
            color: #0c5460;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 1.5rem;
        }
        .btn-block {
            width: 100%;
            padding: 12px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    @include('partials.header')

    <!-- Success Section -->
    <section class="success-section">
        <div class="container">
            <div class="success-container">
                <div class="success-header">
                    <h1>Application Submitted</h1>
                </div>
                <div class="success-body">
                    <div class="success-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    
                    <h3>Thank You!</h3>
                    <p>Your application has been submitted successfully.</p>
                    
                    <div class="alert-info">
                        <p>We will review your application and get back to you within 2-3 business days.</p>
                        <p>Please check your email for a confirmation message.</p>
                    </div>
                    
                    <a href="{{ route('home') }}" class="btn btn-block">Return to Homepage</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('partials.footer')

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html> 