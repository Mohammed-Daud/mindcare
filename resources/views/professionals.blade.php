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
            <h1 class="pt-5">Our Professional Team</h1>
            <p>Meet our licensed psychologists and psychiatrists specializing in various therapeutic approaches.</p>
        </div>
    </section>

    <!-- Professionals Section -->
    <section class="professionals-page">
        <div class="container">
            <!-- Flash Messages -->
            @if(session('error'))
                <div class="alert alert-danger mb-4">
                    {{ session('error') }}
                </div>
            @endif
            
            @if(session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif
            
            <!-- Filter Section -->
            <div class="filter-section">
                <form action="{{ route('professionals') }}" method="GET" class="search-form">
                    <div class="search-box">
                        <input type="text" name="search" placeholder="Search professionals..." value="{{ request('search') }}">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </div>
                    <div class="filter-options">
                        <select name="specialization" onchange="this.form.submit()">
                            <option value="all">All Specializations</option>
                            @foreach($specializations as $specialization)
                                <option value="{{ $specialization }}" {{ request('specialization') == $specialization ? 'selected' : '' }}>
                                    {{ $specialization }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>

            <!-- Professionals Grid -->
            <div class="professionals-grid" id="professionalsGrid">
                @foreach($professionals as $professional)
                <div class="professional-card">
                    <img src="{{ $professional->profile_photo_url }}" 
                         alt="{{ $professional->first_name }} {{ $professional->last_name }}" 
                         class="professional-image">
                    <div class="professional-info">
                        <h3>{{ $professional->first_name }} {{ $professional->last_name }}</h3>
                        <div class="title">{{ $professional->specialization }}</div>
                        <div class="professional-badges">
                            <span class="badge">{{ $professional->qualification }}</span>
                        </div>
                        <div class="professional-stats">
                            <span><i class="fas fa-clock"></i> {{ $professional->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="professional-actions">
                            <a href="{{ route('professionals.show', $professional->slug) }}" class="btn-view-profile">View Profile</a>
                            @auth('client')
                                <a href="{{ route('client.appointments.create', $professional->id) }}" class="btn-book">Book Session</a>
                            @else
                                <a href="{{ route('client.login') }}" class="btn-book">Book Session</a>
                            @endauth
                        </div>
                    </div>
                </div>
                @endforeach
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

    

    <!-- Footer -->
    @include('partials.footer')

    <script src="{{ asset('js/script.js') }}"></script>
    <!-- <script src="{{ asset('js/professionals.js') }}"></script> -->
</body>
</html> 