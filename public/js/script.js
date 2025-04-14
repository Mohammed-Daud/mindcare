// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu functionality
    const mobileMenuBtn = document.querySelector('.mobile-menu');
    const navLinks = document.querySelector('.nav-links');
    
    if (mobileMenuBtn && navLinks) {
        // Toggle menu when clicking the mobile menu button
        mobileMenuBtn.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent event from bubbling up
            toggleMobileMenu();
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (navLinks.classList.contains('active') && 
                !mobileMenuBtn.contains(e.target) && 
                !navLinks.contains(e.target)) {
                closeMobileMenu();
            }
        });
        
        // Close menu when clicking on a nav link
        const navItems = navLinks.querySelectorAll('a');
        navItems.forEach(item => {
            item.addEventListener('click', function() {
                if (navLinks.classList.contains('active')) {
                    closeMobileMenu();
                }
            });
        });
        
        // Function to toggle the mobile menu
        function toggleMobileMenu() {
            navLinks.classList.toggle('active');
            const icon = mobileMenuBtn.querySelector('i');
            
            if (icon) {
                if (navLinks.classList.contains('active')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            }
        }
        
        // Function to close the mobile menu
        function closeMobileMenu() {
            navLinks.classList.remove('active');
            const icon = mobileMenuBtn.querySelector('i');
            
            if (icon) {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        }
    }
});