<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindCare | Professional Online Counseling</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- 
    @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
                <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
            @else
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            @endauth
        </div>
    @endif
     -->
    <!-- Header -->
    @include('partials.header')

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Professional Online Counseling with Licensed Experts</h1>
                    <p class="subtitle">Connect with qualified psychologists and psychiatrists from the comfort of your home. Your mental health matters.</p>
                    <a href="#" class="btn">Get Started Today</a>
                    <a href="#" class="btn btn-outline">Learn More</a>
                </div>
                <div class="hero-image">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MDAiIGhlaWdodD0iNDAwIiB2aWV3Qm94PSIwIDAgNjAwIDQwMCI+CiAgPHJlY3Qgd2lkdGg9IjYwMCIgaGVpZ2h0PSI0MDAiIGZpbGw9IiNlZWVlZWUiLz4KICA8Y2lyY2xlIGN4PSIxNTAiIGN5PSIyMDAiIHI9IjcwIiBmaWxsPSIjY2NjY2NjIi8+CiAgPGNpcmNsZSBjeD0iNDUwIiBjeT0iMjAwIiByPSI3MCIgZmlsbD0iI2NjY2NjYyIvPgogIDxwYXRoIGQ9Ik0yMDAgMjUwIEE1MCA1MCAwIDAgMSAzMDAgMjUwIiBzdHJva2U9IiM5OTkiIHN0cm9rZS13aWR0aD0iMyIgZmlsbD0ibm9uZSIvPgogIDxwYXRoIGQ9Ik0zNTAgMjUwIEE1MCA1MCAwIDAgMSA0NTAgMjUwIiBzdHJva2U9IiM5OTkiIHN0cm9rZS13aWR0aD0iMyIgZmlsbD0ibm9uZSIvPgogIDxsaW5lIHgxPSIyMDAiIHkxPSIzMDAiIHgyPSIzMDAiIHkyPSIzMDAiIHN0cm9rZT0iIzk5OSIgc3Ryb2tlLXdpZHRoPSIzIi8+CiAgPGxpbmUgeDE9IjM1MCIgeTE9IjMwMCIgeDI9IjQ1MCIgeTI9IjMwMCIgc3Ryb2tlPSIjOTk5IiBzdHJva2Utd2lkdGg9IjMiLz4KICA8cmVjdCB4PSIyMDAiIHk9IjEwMCIgd2lkdGg9IjEwMCIgaGVpZ2h0PSI1MCIgZmlsbD0iI2NjY2NjYyIvPgogIDxyZWN0IHg9IjM1MCIgeT0iMTAwIiB3aWR0aD0iMTAwIiBoZWlnaHQ9IjUwIiBmaWxsPSIjY2NjY2NjIi8+CiAgPHRleHQgeD0iMzAwIiB5PSIzNTAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNHB4IiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBmaWxsPSIjNjY2Ij5UaGVyYXBpc3QgYW5kIGNsaWVudCBkaXNjdXNzaW5nPC90ZXh0Pgo8L3N2Zz4=" alt="Therapist talking with client">
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="features">
        <div class="container">
            <div class="section-title">
                <h2>Why Choose Our Online Counseling</h2>
                <p>We connect you with fully qualified and licensed mental health professionals for secure, confidential therapy sessions.</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h3>Licensed Professionals</h3>
                    <p>All our therapists are fully licensed psychologists and psychiatrists with extensive clinical experience.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3>Confidential & Secure</h3>
                    <p>HIPAA-compliant platform ensures your privacy and confidentiality are always protected.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3>Flexible Scheduling</h3>
                    <p>Book sessions at times that work for you, including evenings and weekends.</p>
                </div>
            </div>
        </div>
    </section>

    

    <!-- Professionals Section -->
    <section class="professionals">
        <div class="container">
            <div class="section-title">
                <h2>Our Qualified Professionals</h2>
                <p>Meet our licensed psychologists and psychiatrists specializing in various therapeutic approaches.</p>
            </div>
            <div class="professionals-grid">
                <!-- Professionals will be loaded here dynamically -->
            </div>
            <div class="view-all-container">
                <a href="{{ route('professionals') }}" class="btn btn-outline">
                    <i class="fas fa-users"></i> View All Professionals
                </a>
            </div>
        </div>
    </section>




    <!-- CTA -->
    <section class="cta">
        <div class="container">
            <h2>Ready to Take the First Step?</h2>
            <p>Our licensed professionals are here to help you navigate life's challenges with evidence-based therapeutic approaches.</p>
            <a href="#" class="btn btn-light">Book Your Session Now</a>
        </div>
    </section>

    <!-- Footer -->
    @include('partials.footer')

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/index-professionals.js') }}"></script>
</body>
</html>
