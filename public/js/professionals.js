// Function to load professionals data from JSON file
async function loadProfessionalsData() {
    try {
        // Fetch the professionals data from the JSON file
        const response = await fetch('data/profiles/index.json');
        
        if (!response.ok) {
            throw new Error('Failed to load professionals data');
        }
        
        const data = await response.json();
        return data.professionals;
    } catch (error) {
        console.error('Error loading professionals data:', error);
        return [];
    }
}

// Function to create a professional card
function createProfessionalCard(professional) {
    // Create the professional card HTML with consistent styling
    const cardHTML = `
        <div class="professional-card">
            <img src="${professional.image}" alt="${professional.name}" class="professional-image">
            <div class="professional-info">
                <h3>${professional.name}</h3>
                <div class="title">${professional.title}</div>
                <div class="professional-badges">
                    ${professional.specializations.slice(0, 3).map(spec => `<span class="badge">${spec}</span>`).join('')}
                </div>
                <div class="professional-stats">
                    <span><i class="fas fa-star"></i> ${professional.rating}</span>
                    <span><i class="fas fa-clock"></i> ${professional.experience}</span>
                </div>
                <div class="professional-actions">
                    <a href="profile.html?id=${professional.id}" class="btn-view-profile">View Profile</a>
                    <a href="profile.html?id=${professional.id}" class="btn-book">Book Session</a>
                </div>
            </div>
        </div>
    `;
    
    return cardHTML;
}

// Helper function to get languages for a professional
function getLanguages(professionalId) {
    // This is a simplified version - in a real application, you would load this from the individual JSON files
    const languageMap = {
        'priya_iyer': 'Tamil, English, Hindi',
        'arjun_reddy': 'Telugu, English, Kannada',
        'meenakshi_nair': 'Malayalam, English, Tamil',
        'karthik_shetty': 'Kannada, English, Tulu',
        'michael_chen': 'English, Mandarin',
        'sarah_johnson': 'English, Spanish'
    };
    
    return languageMap[professionalId] || 'English';
}

// Helper function to get session modes for a professional
function getSessionModes(professionalId) {
    // This is a simplified version - in a real application, you would load this from the individual JSON files
    const sessionModeMap = {
        'priya_iyer': 'Video, Chat, Call',
        'arjun_reddy': 'Video, Call',
        'meenakshi_nair': 'Video, Chat',
        'karthik_shetty': 'Video, Call',
        'michael_chen': 'Video, Call, Chat',
        'sarah_johnson': 'Video, Call, Chat, In-person'
    };
    
    return sessionModeMap[professionalId] || 'Video, Call';
}

// Helper function to get consultation types for a professional
function getConsultationTypes(professionalId) {
    // This is a simplified version - in a real application, you would load this from the individual JSON files
    const consultationTypeMap = {
        'priya_iyer': 'Individual, Couples',
        'arjun_reddy': 'Individual',
        'meenakshi_nair': 'Couples, Family',
        'karthik_shetty': 'Individual, Teens',
        'michael_chen': 'Individual, Couples, Family',
        'sarah_johnson': 'Individual, Group'
    };
    
    return consultationTypeMap[professionalId] || 'Individual';
}

// Function to populate the professionals section on the home page
async function populateProfessionalsSection() {
    const professionalsGrid = document.querySelector('.professionals-grid');
    
    if (!professionalsGrid) {
        return;
    }
    
    // Clear existing content
    professionalsGrid.innerHTML = '';
    
    // Load professionals data
    const professionals = await loadProfessionalsData();
    
    // Add each professional to the grid
    professionals.forEach(professional => {
        professionalsGrid.innerHTML += createProfessionalCard(professional);
    });
}

// Initialize the professionals section when the page loads
document.addEventListener('DOMContentLoaded', populateProfessionalsSection);

// DOM Elements
const searchInput = document.querySelector('.search-box input[name="search"]');
const filterSelects = document.querySelectorAll('.filter-options select');
const professionalsGrid = document.querySelector('.professionals-grid');
const noResultsMessage = document.querySelector('.no-results');
const resetFiltersButton = document.querySelector('#resetFilters');

// Initialize the page
document.addEventListener('DOMContentLoaded', async () => {
    // Load professionals data from JSON
    const professionals = await loadProfessionalsData();
    displayProfessionals(professionals);
    setupEventListeners();
    populateFilterOptions(professionals);
});

// Set up event listeners for search and filters
function setupEventListeners() {
    if (searchInput) {
        searchInput.addEventListener('input', filterProfessionals);
    }
    
    if (filterSelects) {
        filterSelects.forEach(select => {
            select.addEventListener('change', filterProfessionals);
        });
    }
    
    if (resetFiltersButton) {
        resetFiltersButton.addEventListener('click', resetFilters);
    }
}

// Reset all filters
function resetFilters() {
    if (searchInput) {
        searchInput.value = '';
    }
    
    if (filterSelects) {
        filterSelects.forEach(select => {
            select.value = 'all';
        });
    }
    
    // Reload all professionals
    loadProfessionalsData().then(professionals => {
        displayProfessionals(professionals);
    });
}

// Filter professionals based on search input and selected filters
function filterProfessionals() {
    const searchTerm = searchInput.value.toLowerCase();
    const specialization = document.querySelector('select[name="specialization"]').value;
    const language = document.querySelector('select[name="language"]').value;
    const sessionType = document.querySelector('select[name="session-type"]').value;

    // Load professionals data
    loadProfessionalsData().then(professionals => {
        const filteredProfessionals = professionals.filter(professional => {
            const matchesSearch = professional.name.toLowerCase().includes(searchTerm) ||
                                professional.title.toLowerCase().includes(searchTerm) ||
                                professional.specializations.some(spec => spec.toLowerCase().includes(searchTerm));
            
            const matchesSpecialization = specialization === 'all' || 
                                        professional.specializations.includes(specialization);
            
            const matchesLanguage = language === 'all' || 
                                  getLanguages(professional.id).toLowerCase().includes(language.toLowerCase());
            
            const matchesSessionType = sessionType === 'all' || 
                                     getSessionModes(professional.id).toLowerCase().includes(sessionType.toLowerCase());

            return matchesSearch && matchesSpecialization && matchesLanguage && matchesSessionType;
        });

        displayProfessionals(filteredProfessionals);
    });
}

// Display professionals in the grid
function displayProfessionals(professionalsToShow) {
    if (professionalsToShow.length === 0) {
        professionalsGrid.style.display = 'none';
        noResultsMessage.style.display = 'block';
        return;
    }

    professionalsGrid.style.display = 'grid';
    noResultsMessage.style.display = 'none';

    professionalsGrid.innerHTML = professionalsToShow.map(professional => `
        <div class="professional-card">
            <img src="${professional.image}" alt="${professional.name}" class="professional-image">
            <div class="professional-info">
                <h3>${professional.name}</h3>
                <div class="title">${professional.title}</div>
                <div class="professional-badges">
                    ${professional.specializations.slice(0, 3).map(spec => `<span class="badge">${spec}</span>`).join('')}
                </div>
                <div class="professional-stats">
                    <span><i class="fas fa-star"></i> ${professional.rating}</span>
                    <span><i class="fas fa-clock"></i> ${professional.experience}</span>
                </div>
                <div class="professional-actions">
                    <a href="profile.html?id=${professional.id}" class="btn-view-profile">View Profile</a>
                    <a href="profile.html?id=${professional.id}" class="btn-book">Book Session</a>
                </div>
            </div>
        </div>
    `).join('');
}

// Populate filter dropdowns with options
function populateFilterOptions(professionals) {
    if (!professionals || !professionals.length) return;
    
    const specializations = [...new Set(professionals.flatMap(p => p.specializations))];
    const languages = [...new Set(professionals.map(p => getLanguages(p.id).split(', ')).flat())];
    const sessionTypes = [...new Set(professionals.map(p => getSessionModes(p.id).split(', ')).flat())];

    const specializationSelect = document.querySelector('select[name="specialization"]');
    const languageSelect = document.querySelector('select[name="language"]');
    const sessionTypeSelect = document.querySelector('select[name="session-type"]');

    if (specializationSelect) {
        specializations.forEach(spec => {
            specializationSelect.innerHTML += `<option value="${spec}">${spec}</option>`;
        });
    }

    if (languageSelect) {
        languages.forEach(lang => {
            languageSelect.innerHTML += `<option value="${lang}">${lang}</option>`;
        });
    }

    if (sessionTypeSelect) {
        sessionTypes.forEach(type => {
            sessionTypeSelect.innerHTML += `<option value="${type}">${type}</option>`;
        });
    }
} 