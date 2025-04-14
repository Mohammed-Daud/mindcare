// Function to get URL parameters
function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
}

// Function to get the professional ID from the URL
function getProfessionalIdFromUrl() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('id');
}

// Function to load professional data
async function loadProfessionalData(professionalId) {
    try {
        // Fetch the professional data from the JSON file
        const response = await fetch(`data/profiles/${professionalId}.json`);
        
        if (!response.ok) {
            throw new Error('Failed to load professional data');
        }
        
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error loading professional data:', error);
        return null;
    }
}

// Function to populate the profile page with data
function populateProfilePage(profileData) {
    if (!profileData) {
        document.body.innerHTML = '<div class="container"><h1>Profile Not Found</h1><p>The requested profile could not be found.</p><a href="index.html" class="btn">Return to Home</a></div>';
        return;
    }
    
    // Update page title
    document.title = `${profileData.name} | MindCare Professional Profile`;
    
    // Update profile image
    const profileImage = document.querySelector('.profile-image img');
    if (profileImage) {
        profileImage.src = profileData.image;
        profileImage.alt = profileData.name;
    }
    
    // Update profile title
    const profileTitle = document.querySelector('.profile-title h1');
    if (profileTitle) {
        profileTitle.textContent = profileData.name;
    }
    
    const profileSubtitle = document.querySelector('.profile-title p');
    if (profileSubtitle) {
        profileSubtitle.textContent = profileData.title;
    }
    
    // Update profile badges
    const profileBadges = document.querySelectorAll('.profile-badge');
    if (profileBadges.length >= 3) {
        profileBadges[0].innerHTML = `<i class="fas fa-award"></i> ${profileData.stats.experience}`;
        profileBadges[1].innerHTML = `<i class="fas fa-user-md"></i> ${profileData.stats.sessions}`;
        profileBadges[2].innerHTML = `<i class="fas fa-star"></i> ${profileData.stats.rating}`;
    }
    
    // Update about section
    const aboutText = document.querySelector('.profile-about p');
    if (aboutText) {
        aboutText.textContent = profileData.about;
    }
    
    // Update languages
    const languagesContainer = document.querySelector('.detail-card:nth-child(1)');
    if (languagesContainer && profileData.languages && profileData.languages.length > 0) {
        languagesContainer.innerHTML = `<h3><i class="fas fa-language"></i> Languages</h3>`;
        
        profileData.languages.forEach(lang => {
            const langItem = document.createElement('div');
            langItem.className = 'detail-item';
            langItem.innerHTML = `<i class="fas fa-check"></i><span>${lang.name} (${lang.proficiency})</span>`;
            languagesContainer.appendChild(langItem);
        });
    }
    
    // Update consultation types
    const consultationContainer = document.querySelector('.detail-card:nth-child(2)');
    if (consultationContainer && profileData.consultation_types && profileData.consultation_types.length > 0) {
        consultationContainer.innerHTML = `<h3><i class="fas fa-user-tie"></i> Consultation Types</h3>`;
        
        profileData.consultation_types.forEach(consult => {
            const consultItem = document.createElement('div');
            consultItem.className = 'detail-item';
            consultItem.innerHTML = `<i class="fas fa-${consult.icon}"></i><span>${consult.type}</span>`;
            if (consult.note) {
                consultItem.innerHTML += `<span class="note">(${consult.note})</span>`;
            }
            consultationContainer.appendChild(consultItem);
        });
    }
    
    // Update session modes
    const sessionModesContainer = document.querySelector('.detail-card:nth-child(3)');
    if (sessionModesContainer && profileData.session_modes && profileData.session_modes.length > 0) {
        sessionModesContainer.innerHTML = `<h3><i class="fas fa-laptop-house"></i> Session Modes</h3>`;
        
        profileData.session_modes.forEach(session => {
            const sessionItem = document.createElement('div');
            sessionItem.className = 'detail-item';
            sessionItem.innerHTML = `<i class="fas fa-${session.icon}"></i><span>${session.mode}</span>`;
            sessionModesContainer.appendChild(sessionItem);
        });
    }
    
    // Update qualifications
    const qualificationsContainer = document.querySelector('.detail-card:nth-child(4)');
    if (qualificationsContainer && profileData.qualifications && profileData.qualifications.length > 0) {
        qualificationsContainer.innerHTML = `<h3><i class="fas fa-graduation-cap"></i> Qualifications</h3>`;
        
        profileData.qualifications.forEach(qual => {
            const qualItem = document.createElement('div');
            qualItem.className = 'detail-item';
            
            if (qual.degree) {
                qualItem.innerHTML = `<i class="fas fa-certificate"></i><span>${qual.degree} (${qual.institution})</span>`;
            } else if (qual.certification) {
                qualItem.innerHTML = `<i class="fas fa-certificate"></i><span>${qual.certification}</span>`;
            }
            
            qualificationsContainer.appendChild(qualItem);
        });
    }
    
    // Update specializations
    const specializationsContainer = document.querySelector('.specialization-tags');
    if (specializationsContainer && profileData.specializations.length > 0) {
        specializationsContainer.innerHTML = '';
        
        profileData.specializations.forEach(spec => {
            const specTag = document.createElement('span');
            specTag.className = 'specialization-tag';
            specTag.textContent = spec;
            specializationsContainer.appendChild(specTag);
        });
    }
    
    // Update CTA section
    const ctaText = document.querySelector('.profile-cta p');
    if (ctaText) {
        ctaText.textContent = `${profileData.name} is currently accepting new clients for online sessions`;
    }
    
    // Update booking and question URLs
    const bookingBtn = document.querySelector('.profile-cta .btn:first-of-type');
    if (bookingBtn) {
        bookingBtn.href = profileData.contact.booking_url;
    }
    
    const questionBtn = document.querySelector('.profile-cta .btn.btn-outline');
    if (questionBtn) {
        questionBtn.href = profileData.contact.question_url;
    }
}

// Function to update the profile page with professional data
function updateProfilePage(professional) {
    if (!professional) {
        // Handle case where professional data couldn't be loaded
        document.querySelector('.profile-hero').innerHTML = `
            <div class="container">
                <div class="error-message">
                    <h2>Professional Not Found</h2>
                    <p>The requested professional profile could not be found.</p>
                    <a href="professionals.html" class="btn">View All Professionals</a>
                </div>
            </div>
        `;
        return;
    }
    
    // Update page title
    document.title = `${professional.name} | MindCare Professional Profile`;
    
    // Update profile image
    document.querySelector('.profile-image img').src = professional.image;
    document.querySelector('.profile-image img').alt = professional.name;
    
    // Update profile content
    document.querySelector('.profile-title h1').textContent = professional.name;
    document.querySelector('.profile-title p').textContent = professional.title;
    
    // Update profile badges
    const profileBadges = document.querySelector('.profile-title');
    profileBadges.innerHTML = `
        <h1>${professional.name}</h1>
        <p>${professional.title}</p>
        <span class="profile-badge"><i class="fas fa-award"></i> ${professional.stats.experience}</span>
        <span class="profile-badge"><i class="fas fa-user-md"></i> ${professional.stats.sessions}</span>
        <span class="profile-badge"><i class="fas fa-star"></i> ${professional.stats.rating}</span>
    `;
    
    // Update profile about
    document.querySelector('.profile-about p').textContent = professional.about;
    
    // Update languages
    const languagesContainer = document.querySelector('.detail-card:nth-child(1)');
    if (languagesContainer && professional.languages && professional.languages.length > 0) {
        languagesContainer.innerHTML = `<h3><i class="fas fa-language"></i> Languages</h3>`;
        
        professional.languages.forEach(lang => {
            const langItem = document.createElement('div');
            langItem.className = 'detail-item';
            langItem.innerHTML = `<i class="fas fa-check"></i><span>${lang.name} (${lang.proficiency})</span>`;
            languagesContainer.appendChild(langItem);
        });
    }
    
    // Update consultation types
    const consultationContainer = document.querySelector('.detail-card:nth-child(2)');
    if (consultationContainer && professional.consultation_types && professional.consultation_types.length > 0) {
        consultationContainer.innerHTML = `<h3><i class="fas fa-user-tie"></i> Consultation Types</h3>`;
        
        professional.consultation_types.forEach(consult => {
            const consultItem = document.createElement('div');
            consultItem.className = 'detail-item';
            consultItem.innerHTML = `<i class="fas fa-${consult.icon}"></i><span>${consult.type}</span>`;
            if (consult.note) {
                consultItem.innerHTML += `<span class="note">(${consult.note})</span>`;
            }
            consultationContainer.appendChild(consultItem);
        });
    }
    
    // Update session modes
    const sessionModesContainer = document.querySelector('.detail-card:nth-child(3)');
    if (sessionModesContainer && professional.session_modes && professional.session_modes.length > 0) {
        sessionModesContainer.innerHTML = `<h3><i class="fas fa-laptop-house"></i> Session Modes</h3>`;
        
        professional.session_modes.forEach(session => {
            const sessionItem = document.createElement('div');
            sessionItem.className = 'detail-item';
            sessionItem.innerHTML = `<i class="fas fa-${session.icon}"></i><span>${session.mode}</span>`;
            sessionModesContainer.appendChild(sessionItem);
        });
    }
    
    // Update qualifications
    const qualificationsContainer = document.querySelector('.detail-card:nth-child(4)');
    if (qualificationsContainer && professional.qualifications && professional.qualifications.length > 0) {
        qualificationsContainer.innerHTML = `<h3><i class="fas fa-graduation-cap"></i> Qualifications</h3>`;
        
        professional.qualifications.forEach(qual => {
            const qualItem = document.createElement('div');
            qualItem.className = 'detail-item';
            
            if (qual.degree) {
                qualItem.innerHTML = `<i class="fas fa-certificate"></i><span>${qual.degree} (${qual.institution})</span>`;
            } else if (qual.certification) {
                qualItem.innerHTML = `<i class="fas fa-certificate"></i><span>${qual.certification}</span>`;
            }
            
            qualificationsContainer.appendChild(qualItem);
        });
    }
    
    // Update specializations
    const specializationsContainer = document.querySelector('.specialization-tags');
    specializationsContainer.innerHTML = professional.specializations.map(spec => `
        <span class="specialization-tag">${spec}</span>
    `).join('');
    
    // Update CTA section
    const ctaSection = document.querySelector('.profile-cta');
    ctaSection.innerHTML = `
        <h2>Ready to Begin Your Healing Journey?</h2>
        <p>${professional.name} is currently accepting new clients for online sessions</p>
        <a href="profile.html?id=${professional.id}" class="btn"><i class="fas fa-calendar-alt"></i> Book Your First Session</a>
        <a href="#" class="btn btn-outline"><i class="fas fa-question-circle"></i> Ask a Question</a>
    `;
    
    // Update book session buttons
    const bookSessionButtons = document.querySelectorAll('.btn');
    bookSessionButtons.forEach(button => {
        if (button.textContent.includes('Book')) {
            button.href = `profile.html?id=${professional.id}`;
        }
    });
}

// Initialize the profile page when it loads
document.addEventListener('DOMContentLoaded', async () => {
    const professionalId = getProfessionalIdFromUrl();
    
    if (professionalId) {
        const professional = await loadProfessionalData(professionalId);
        updateProfilePage(professional);
    } else {
        // Handle case where no ID is provided
        document.querySelector('.profile-hero').innerHTML = `
            <div class="container">
                <div class="error-message">
                    <h2>No Professional Selected</h2>
                    <p>Please select a professional from our team page.</p>
                    <a href="professionals.html" class="btn">View All Professionals</a>
                </div>
            </div>
        `;
    }
}); 