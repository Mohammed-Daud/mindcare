<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Team | MindCare Professional Counseling</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/professionals.css') }}">
</head>
<body>
    <!-- Header -->
    @include('partials.header')
    
    <!-- Page Title -->
    <section class="page-title">
        <div class="container">
            <h1>Our Professional Team</h1>
            <p>Meet our licensed psychologists and psychiatrists specializing in various therapeutic approaches.</p>
        </div>
    </section>

    <!-- Professionals Section -->
    <section class="professionals-page">
        <div class="container">
            <!-- Filter Section -->
            <div class="filter-section">
                <div class="search-box">
                    <input type="text" name="search" placeholder="Search professionals...">
                    <button type="button"><i class="fas fa-search"></i></button>
                </div>
                <div class="filter-options">
                    <select name="specialization">
                        <option value="all">All Specializations</option>
                        <!-- Options will be populated dynamically -->
                    </select>
                    <select name="language">
                        <option value="all">All Languages</option>
                        <!-- Options will be populated dynamically -->
                    </select>
                    <select name="session-type">
                        <option value="all">All Session Types</option>
                        <!-- Options will be populated dynamically -->
                    </select>
                </div>
            </div>

            <!-- Professionals Grid -->
            <div class="professionals-grid" id="professionalsGrid">
                <!-- Professionals will be loaded here dynamically -->
            </div>

            <!-- No Results Message -->
            <div class="no-results" id="noResults" style="display: none;">
                <i class="fas fa-search"></i>
                <h3>No professionals found</h3>
                <p>Try adjusting your search criteria</p>
                <button id="resetFilters" class="btn btn-outline">Reset Filters</button>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
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
    <script src="{{ asset('js/professionals.js') }}"></script>
    <script src="{{ asset('js/professionals-page.js') }}"></script>
</body>
</html> 