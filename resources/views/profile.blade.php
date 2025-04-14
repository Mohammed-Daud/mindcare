<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr. Priya Iyer | MindCare Professional Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>
    <!-- Header - Reuse your existing header -->
    @include('partials.header')

    <!-- Profile Hero Section -->
    <section class="profile-hero">
        <div class="container">
            <div class="profile-container">
                <div class="profile-image">
                    <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80" alt="Dr. Priya Iyer">
                </div>
                <div class="profile-content">
                    <div class="profile-title">
                        <h1>Dr. Priya Iyer</h1>
                        <p>Clinical Psychologist, PhD</p>
                        <span class="profile-badge"><i class="fas fa-award"></i> 12+ Years Experience</span>
                        <span class="profile-badge"><i class="fas fa-user-md"></i> 2000+ Sessions</span>
                        <span class="profile-badge"><i class="fas fa-star"></i> 4.9/5 Rating</span>
                    </div>
                    
                    <div class="profile-about">
                        <p>Dr. Priya is a licensed clinical psychologist specializing in cognitive behavioral therapy with extensive experience helping clients manage anxiety, depression, and relationship issues. She adopts a culturally-sensitive approach tailored to Indian clients, blending Western therapeutic techniques with an understanding of Indian family dynamics and social pressures.</p>
                    </div>
                    
                    <a href="profile.html?id=priya_iyer" class="btn"><i class="fas fa-calendar-check"></i> Book Session</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Profile Details Section -->
    <section class="container">
        <div class="profile-details">
            <div class="detail-card">
                <h3><i class="fas fa-language"></i> Languages</h3>
                <div class="detail-item">
                    <i class="fas fa-check"></i>
                    <span>Tamil (Fluent)</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-check"></i>
                    <span>English (Fluent)</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-check"></i>
                    <span>Hindi (Professional)</span>
                </div>
            </div>
            
            <div class="detail-card">
                <h3><i class="fas fa-user-tie"></i> Consultation Types</h3>
                <div class="detail-item">
                    <i class="fas fa-user"></i>
                    <span>Individual Therapy</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-user-friends"></i>
                    <span>Couples Counseling</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-users"></i>
                    <span>Family Therapy (Limited)</span>
                </div>
            </div>
            
            <div class="detail-card">
                <h3><i class="fas fa-laptop-house"></i> Session Modes</h3>
                <div class="detail-item">
                    <i class="fas fa-video"></i>
                    <span>Video Call</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-phone-alt"></i>
                    <span>Voice Call</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-comment-dots"></i>
                    <span>Chat Messaging</span>
                </div>
            </div>
            
            <div class="detail-card">
                <h3><i class="fas fa-graduation-cap"></i> Qualifications</h3>
                <div class="detail-item">
                    <i class="fas fa-certificate"></i>
                    <span>PhD in Clinical Psychology (NIMHANS)</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-certificate"></i>
                    <span>Licensed RCI Practitioner</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-certificate"></i>
                    <span>Certified CBT Practitioner</span>
                </div>
            </div>
        </div>
        
        <!-- Specializations -->
        <div class="specializations">
            <h2>Areas of Specialization</h2>
            <div class="specialization-tags">
                <span class="specialization-tag">Anxiety Disorders</span>
                <span class="specialization-tag">Depression</span>
                <span class="specialization-tag">Cognitive Behavioral Therapy</span>
                <span class="specialization-tag">Stress Management</span>
                <span class="specialization-tag">Relationship Issues</span>
                <span class="specialization-tag">Workplace Stress</span>
                <span class="specialization-tag">Cultural Adjustment</span>
                <span class="specialization-tag">Self-Esteem</span>
                <span class="specialization-tag">Women's Mental Health</span>
            </div>
        </div>
        
        <!-- CTA Section -->
        <div class="profile-cta">
            <h2>Ready to Begin Your Healing Journey?</h2>
            <p>Dr. Priya is currently accepting new clients for online sessions</p>
            <a href="profile.html?id=priya_iyer" class="btn"><i class="fas fa-calendar-alt"></i> Book Your First Session</a>
            <a href="#" class="btn btn-outline"><i class="fas fa-question-circle"></i> Ask a Question</a>
        </div>
    </section>

    <!-- Footer - Reuse your existing footer -->
    @include('partials.footer')
    
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/profile.js') }}"></script>
</body>
</html>