// Notification function
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transform transition-all duration-300 translate-x-full`;

    // Set colors based on type
    if (type === 'success') {
        notification.className += ' bg-green-500 text-white';
    } else if (type === 'error') {
        notification.className += ' bg-red-500 text-white';
    } else {
        notification.className += ' bg-blue-500 text-white';
    }

    notification.innerHTML = `
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-[20px]">
                ${type === 'success' ? 'check_circle' : type === 'error' ? 'error' : 'info'}
            </span>
            <span>${message}</span>
        </div>
    `;

    // Add to page
    document.body.appendChild(notification);

    // Slide in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);

    // Remove after 5 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 5000);
}

// Password validation functions
function initPasswordStrengthChecker(passwordInput, options = {}) {
    const {
        strengthBars = null,
        requirementCheckboxes = null,
        onStrengthChange = null
    } = options;

    if (!passwordInput) return;

    // Password visibility toggle
    const visibilityToggle = passwordInput.parentElement.querySelector('button[type="button"]');
    if (visibilityToggle) {
        const visibilityIcon = visibilityToggle.querySelector('span');

        visibilityToggle.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            visibilityIcon.textContent = type === 'password' ? 'visibility_off' : 'visibility';
        });
    }

    // Password strength checker
    function checkPasswordStrength(password) {
        let strength = 0;

        // Update strength based on centralized requirements
        if (typeof passwordRequirements !== 'undefined') {
            Object.keys(passwordRequirements).forEach(key => {
                const requirement = passwordRequirements[key];
                const passed = new RegExp(requirement.regex).test(password);
                if (passed) strength++;

                // Update requirement checkboxes if available
                if (requirementCheckboxes && requirementCheckboxes[key]) {
                    updateRequirement(key, passed);
                }
            });
        } else {
            // Fallback basic strength check
            if (password.length >= 8) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^a-zA-Z0-9]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
        }

        return Math.min(strength, 4);
    }

    function updateRequirement(type, passed) {
        if (!requirementCheckboxes || !requirementCheckboxes[type]) return;

        const checkIcon = document.getElementById(`check-${type}`);
        const reqElement = document.getElementById(`req-${type}`);

        if (checkIcon && reqElement) {
            if (passed) {
                checkIcon.textContent = 'check_circle';
                checkIcon.className = 'material-symbols-outlined text-sm text-green-500';
                reqElement.querySelector('span:last-child').className = 'text-xs text-green-500 dark:text-green-400';
            } else {
                checkIcon.textContent = 'radio_button_unchecked';
                checkIcon.className = 'material-symbols-outlined text-sm text-gray-300 dark:text-gray-600';
                reqElement.querySelector('span:last-child').className = 'text-xs text-secondary dark:text-gray-400';
            }
        }
    }

    function updateStrengthMeter(strength) {
        if (!strengthBars) return;

        // Reset all bars
        strengthBars.forEach(bar => {
            bar.classList.add('hidden');
            bar.className = 'w-full h-full bg-red-400 rounded-full hidden';
        });

        // Colors for different strength levels
        const colors = ['bg-red-400', 'bg-orange-400', 'bg-yellow-400', 'bg-green-400'];

        // Update bars based on strength
        for (let i = 0; i < strength; i++) {
            const bar = strengthBars[i];
            bar.classList.remove('hidden');
            bar.className = `w-full h-full ${colors[strength - 1]} rounded-full`;
        }
    }

    // Listen for password input
    passwordInput.addEventListener('input', function() {
        const strength = checkPasswordStrength(this.value);
        updateStrengthMeter(strength);

        if (onStrengthChange) {
            onStrengthChange(strength);
        }
    });

    return {
        checkStrength: checkPasswordStrength,
        updateMeter: updateStrengthMeter
    };
}

