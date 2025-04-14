// Sample data for professionals (in a real application, this would come from a database or API)
const professionals = [
    {
        id: 'priya_iyer',
        name: 'Dr. Priya Iyer',
        title: 'Clinical Psychologist, PhD',
        specializations: ['Anxiety Disorders', 'Depression', 'Cognitive Behavioral Therapy'],
        languages: ['Tamil', 'English', 'Hindi'],
        sessionTypes: ['Video Call', 'Voice Call', 'Chat Messaging'],
        experience: '12+ years',
        rating: 4.9,
        profileUrl: 'profile?id=priya_iyer',
        imageUrl: 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80'
    },
    {
        id: 'arjun_reddy',
        name: 'Dr. Arjun Reddy',
        title: 'Psychiatrist, MD',
        specializations: ['ADHD', 'Mood Disorders', 'Anxiety Disorders'],
        languages: ['Telugu', 'English', 'Kannada'],
        sessionTypes: ['Video Call', 'Voice Call'],
        experience: '8+ years',
        rating: 4.8,
        profileUrl: 'profile?id=arjun_reddy',
        imageUrl: 'https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80'
    },
    {
        id: 'meenakshi_nair',
        name: 'Dr. Meenakshi Nair',
        title: 'Counseling Psychologist, PsyD',
        specializations: ['Marital Counseling', 'Family Therapy', 'Relationship Issues'],
        languages: ['Malayalam', 'English', 'Tamil'],
        sessionTypes: ['Video Call', 'Chat Messaging'],
        experience: '10+ years',
        rating: 4.9,
        profileUrl: 'profile?id=meenakshi_nair',
        imageUrl: 'https://images.unsplash.com/photo-1554151228-14d9def656e4?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80'
    },
    {
        id: 'karthik_shetty',
        name: 'Dr. Karthik Shetty',
        title: 'Clinical Psychologist, PhD',
        specializations: ['Trauma', 'PTSD', 'Adolescent Issues'],
        languages: ['Kannada', 'English', 'Tulu'],
        sessionTypes: ['Video Call', 'Voice Call'],
        experience: '9+ years',
        rating: 4.8,
        profileUrl: 'profile?id=karthik_shetty',
        imageUrl: 'https://images.unsplash.com/photo-1562788869-4ed32648eb72?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80'
    }
];

// Function to create a professional card
function createProfessionalCard(professional) {
    const card = document.createElement('div');
    card.className = 'professional-card';
    
    card.innerHTML = `
        <div class="professional-image" style="background-image: url('${professional.imageUrl}');"></div>
        <div class="professional-info">
            <h3>${professional.name}</h3>
            <p class="specialization">${professional.title}</p>
            
            <div class="professional-details">
                <div class="detail-item">
                    <i class="fas fa-language"></i>
                    <span>${professional.languages.join(', ')}</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-star"></i>
                    <span>${professional.specializations.join(', ')}</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-video"></i>
                    <span>${professional.sessionTypes.join(', ')}</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-user-friends"></i>
                    <span>${professional.experience} experience</span>
                </div>
            </div>
            <a href="${professional.profileUrl}" class="btn btn-small">View Profile</a>
        </div>
    `;
    
    return card;
}

// Function to display professionals
function displayProfessionals() {
    const professionalsGrid = document.querySelector('.professionals-grid');
    if (!professionalsGrid) return;
    
    professionalsGrid.innerHTML = '';
    
    professionals.forEach(professional => {
        const card = createProfessionalCard(professional);
        professionalsGrid.appendChild(card);
    });
}

// Initialize when the DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    displayProfessionals();
}); 