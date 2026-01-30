<!DOCTYPE html>
<html class="light" lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }} - Doctor Onboarding</title>
        <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&amp;family=Noto+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
        <script id="tailwind-config">
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        colors: {
                            "primary": "#13b6ec",
                            "primary-hover": "#0ea5d6",
                            "background-light": "#f8fbfc",
                            "background-dark": "#101d22",
                            "surface-light": "#ffffff",
                            "surface-dark": "#1a2c33",
                            "text-main-light": "#0d181b",
                            "text-main-dark": "#e0e6e8",
                            "text-secondary-light": "#4c869a",
                            "text-secondary-dark": "#94aab2",
                            "border-light": "#cfe1e7",
                            "border-dark": "#2c4048",
                        },
                        fontFamily: {
                            "display": ["Lexend", "sans-serif"],
                            "body": ["Noto Sans", "sans-serif"],
                        },
                        borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                    },
                },
            }
        </script>
        <style>
            body { font-family: 'Lexend', 'Noto Sans', sans-serif; }
        </style>
    </head>
    <body class="bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark min-h-screen flex flex-col">
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-border-light dark:border-border-dark px-10 py-4 bg-surface-light dark:bg-surface-dark sticky top-0 z-50">
            <div class="flex items-center gap-4">
                <div class="size-8 text-primary">
                    <svg class="w-full h-full" fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24 4C25.7818 14.2173 33.7827 22.2182 44 24C33.7827 25.7818 25.7818 33.7827 24 44C22.2182 33.7827 14.2173 25.7818 4 24C14.2173 22.2182 22.2182 14.2173 24 4Z" fill="currentColor"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold leading-tight tracking-[-0.015em] text-text-main-light dark:text-text-main-dark">
                    {{ config('app.name') }}
                </h2>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-text-secondary-light dark:text-text-secondary-dark hidden sm:block">Already have an account?</span>
                <a class="text-sm font-bold text-primary hover:text-primary-hover" href="{{ route('doctor.onboarding.step1') }}">Log in</a>
                <button class="ml-4 flex items-center justify-center overflow-hidden rounded-lg h-9 px-4 bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark text-sm font-bold leading-normal hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    <span class="material-symbols-outlined text-[18px] mr-2">help</span>
                    <span class="truncate">Help</span>
                </button>
                <a class="ml-4 flex items-center justify-center overflow-hidden rounded-lg h-9 px-4 bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark text-sm font-bold leading-normal hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" href="{{ route('home') }}">
                    <span class="material-symbols-outlined text-[18px] mr-2">home</span>
                    <span class="truncate">Home</span>
                </a>
            </div>
        </header>
        <main class="flex-1 flex flex-col lg:flex-row">
            <div class="flex-1 flex justify-center py-10 px-4 sm:px-10 lg:px-20 overflow-y-auto">
                <div class="w-full max-w-[540px] flex flex-col gap-8">
                    <div class="flex flex-col gap-3">
                        <div class="flex gap-6 justify-between items-center">
                            <p class="text-text-main-light dark:text-text-main-dark text-sm font-bold uppercase tracking-wider">Step 1 of 3: Account Creation</p>
                            <span class="text-xs text-text-secondary-light dark:text-text-secondary-dark font-medium">Next: Credentials</span>
                        </div>
                        <div class="rounded-full bg-slate-200 dark:bg-slate-700 h-2 overflow-hidden">
                            <div class="h-full rounded-full bg-primary" style="width: 33%;"></div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-text-main-light dark:text-text-main-dark tracking-tight text-3xl md:text-4xl font-bold leading-tight">Start Your Practice</h1>
                        <p class="text-text-secondary-light dark:text-text-secondary-dark text-base font-normal leading-relaxed">
                            Create your secure account to begin treating patients. Your data is encrypted and protected.
                        </p>
                    </div>
                    <form class="flex flex-col gap-6" onsubmit="event.preventDefault();">
                        <label class="flex flex-col gap-2">
                            <span class="text-text-main-light dark:text-text-main-dark text-sm font-semibold leading-normal">Professional Email Address</span>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-text-secondary-light dark:text-text-secondary-dark text-[20px]">mail</span>
                                <input class="form-input flex w-full rounded-lg text-text-main-light dark:text-text-main-dark focus:outline-0 focus:ring-2 focus:ring-primary/20 border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark focus:border-primary h-12 pl-12 pr-4 placeholder:text-text-secondary-light/50 dark:placeholder:text-text-secondary-dark/50 text-base font-normal transition-all" placeholder="dr.lastname@example.com" required="" type="email" name="email"/>
                            </div>
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="flex flex-col gap-2">
                                <span class="text-text-main-light dark:text-text-main-dark text-sm font-semibold leading-normal">Create Password</span>
                                <div class="relative group">
                                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-text-secondary-light dark:text-text-secondary-dark text-[20px]">lock</span>
                                    <input class="form-input flex w-full rounded-lg text-text-main-light dark:text-text-main-dark focus:outline-0 focus:ring-2 focus:ring-primary/20 border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark focus:border-primary h-12 pl-12 pr-10 placeholder:text-text-secondary-light/50 dark:placeholder:text-text-secondary-dark/50 text-base font-normal transition-all" placeholder="••••••••" required="" type="password" id="password" name="password"/>
                                    <button class="absolute right-3 top-1/2 -translate-y-1/2 text-text-secondary-light dark:text-text-secondary-dark hover:text-primary transition-colors" type="button">
                                    <span class="material-symbols-outlined text-[20px]">visibility_off</span>
                                    </button>
                                </div>
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-text-main-light dark:text-text-main-dark text-sm font-semibold leading-normal">Confirm Password</span>
                                <div class="relative group">
                                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-text-secondary-light dark:text-text-secondary-dark text-[20px]">lock_reset</span>
                                    <input class="form-input flex w-full rounded-lg text-text-main-light dark:text-text-main-dark focus:outline-0 focus:ring-2 focus:ring-primary/20 border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark focus:border-primary h-12 pl-12 pr-10 placeholder:text-text-secondary-light/50 dark:placeholder:text-text-secondary-dark/50 text-base font-normal transition-all" placeholder="••••••••" required="" type="password" id="password_confirmation" name="password_confirmation"/>
                                    <button class="absolute right-3 top-1/2 -translate-y-1/2 text-text-secondary-light dark:text-text-secondary-dark hover:text-primary transition-colors" type="button">
                                    <span class="material-symbols-outlined text-[20px]">visibility_off</span>
                                    </button>
                                </div>
                            </label>
                        </div>
                        <!-- Password Strength Meter -->
                        <div class="flex gap-1 mt-2 h-1">
                            <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-full">
                                <div class="w-full h-full bg-red-400 rounded-full hidden"></div>
                            </div>
                            <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-full">
                                <div class="w-full h-full bg-red-400 rounded-full hidden"></div>
                            </div>
                            <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-full">
                                <div class="w-full h-full bg-red-400 rounded-full hidden"></div>
                            </div>
                            <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-full">
                                <div class="w-full h-full bg-red-400 rounded-full hidden"></div>
                            </div>
                        </div>
                        <div class="bg-primary/5 dark:bg-primary/10 p-3 rounded-lg border border-primary/10 dark:border-primary/20 flex gap-3 items-start">
                            <span class="material-symbols-outlined text-primary text-[20px] mt-0.5">info</span>
                            <div class="text-xs text-text-secondary-light dark:text-text-secondary-dark leading-relaxed">
                                Password must be at least 8 characters long and include a number, a symbol, and an uppercase letter to meet HIPAA security standards.
                            </div>
                        </div>

                        <label class="flex gap-3 items-start cursor-pointer group">
                            <div class="relative flex items-center">
                                <input class="peer h-5 w-5 cursor-pointer appearance-none rounded border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark checked:bg-primary checked:border-primary transition-all" type="checkbox" id="terms" name="terms" required/>
                                <span class="material-symbols-outlined absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white opacity-0 peer-checked:opacity-100 text-[16px] pointer-events-none">check</span>
                            </div>
                            <span class="text-sm text-text-secondary-light dark:text-text-secondary-dark leading-normal select-none group-hover:text-text-main-light dark:group-hover:text-text-main-dark transition-colors">
                            I agree to the <a class="text-primary underline decoration-primary/30 hover:decoration-primary" href="#">Terms of Service</a> and <a class="text-primary underline decoration-primary/30 hover:decoration-primary" href="#">Privacy Policy</a>.
                            </span>
                        </label>
                        <button class="mt-2 w-full flex items-center justify-center gap-2 rounded-lg bg-primary hover:bg-primary-hover text-white h-12 px-6 text-base font-bold leading-normal tracking-[0.015em] shadow-sm hover:shadow-md transition-all" type="submit" id="submitBtn">
                        <span id="btnText">Create Secure Account</span>
                        <span id="btnIcon" class="material-symbols-outlined text-[20px]">arrow_forward</span>
                        <div id="loadingSpinner" class="hidden">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                        </button>
                        <div class="flex justify-center items-center gap-2 mt-2">
                            <span class="material-symbols-outlined text-green-600 text-[18px]">verified_user</span>
                            <span class="text-xs font-medium text-text-secondary-light dark:text-text-secondary-dark uppercase tracking-wider">HIPAA Compliant &amp; Secure</span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="hidden lg:flex lg:w-[45%] xl:w-[40%] bg-surface-light dark:bg-surface-dark border-l border-border-light dark:border-border-dark relative overflow-hidden flex-col justify-between p-12">
                <div class="absolute inset-0 z-0 opacity-40 dark:opacity-20 bg-gradient-to-br from-primary/10 via-background-light to-primary/5 pointer-events-none"></div>
                <div class="absolute top-[-10%] right-[-10%] w-[60%] h-[60%] rounded-full bg-gradient-to-br from-primary/20 to-transparent blur-3xl pointer-events-none"></div>
                <div class="relative z-10">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-wide mb-6">
                        Trusted by 5000+ Psychiatrists
                    </div>
                    <h3 class="text-3xl font-bold text-text-main-light dark:text-text-main-dark mb-4 leading-snug">
                        Reinventing how you connect with patients.
                    </h3>
                    <p class="text-text-secondary-light dark:text-text-secondary-dark text-lg leading-relaxed">
                        "PsychiatryPortal has transformed my private practice. The onboarding was seamless, and the secure environment gives my patients peace of mind."
                    </p>
                </div>
                <div class="relative z-10 mt-auto">
                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 rounded-full bg-slate-200 dark:bg-slate-700 overflow-hidden border-2 border-white dark:border-slate-600 shadow-sm relative" data-alt="Portrait of a smiling doctor in a white coat">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-100 to-blue-200 dark:from-slate-600 dark:to-slate-700 flex items-center justify-center text-primary dark:text-white font-bold text-lg">JS</div>
                        </div>
                        <div>
                            <p class="text-text-main-light dark:text-text-main-dark font-bold text-sm">Dr. Julia Sarah</p>
                            <p class="text-text-secondary-light dark:text-text-secondary-dark text-xs">Clinical Psychiatrist, MD</p>
                        </div>
                    </div>
                    <div class="mt-8 pt-8 border-t border-border-light dark:border-border-dark flex justify-between items-center text-xs text-text-secondary-light dark:text-text-secondary-dark">
                        <span>© {{ date('Y') }} {{ config('app.name') }}.</span>
                        <div class="flex gap-4">
                            <a class="hover:text-primary" href="#">Privacy</a>
                            <a class="hover:text-primary" href="#">Terms</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script>
            // App URL from .env
            const APP_URL = "{{ config('app.url') }}";

            // Password requirements from centralized service
            const passwordRequirements = @json(\App\Services\PasswordValidationService::getRequirements());

            document.addEventListener('DOMContentLoaded', function() {
                const passwordInput = document.getElementById('password');
                const confirmPasswordInput = document.getElementById('password_confirmation');
                const strengthBars = document.querySelectorAll('.flex.gap-1.mt-2.h-1 > div > div');

                // Initialize password strength checker for both password fields
                initPasswordStrengthChecker(passwordInput, {
                    strengthBars: strengthBars
                });

                // Initialize password visibility toggle for confirm password
                const confirmVisibilityToggle = confirmPasswordInput.parentElement.querySelector('button[type="button"]');
                if (confirmVisibilityToggle) {
                    const confirmVisibilityIcon = confirmVisibilityToggle.querySelector('span');

                    confirmVisibilityToggle.addEventListener('click', function() {
                        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                        confirmPasswordInput.setAttribute('type', type);
                        confirmVisibilityIcon.textContent = type === 'password' ? 'visibility_off' : 'visibility';
                    });
                }

                // Form submission with AJAX
                const form = document.querySelector('form');
                const submitBtn = document.getElementById('submitBtn');
                const btnText = document.getElementById('btnText');
                const btnIcon = document.getElementById('btnIcon');
                const loadingSpinner = document.getElementById('loadingSpinner');

                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Check if form is valid
                    if (!form.checkValidity()) {
                        form.reportValidity();
                        return;
                    }

                    // Show loading state
                    submitBtn.disabled = true;
                    btnText.textContent = 'Creating Account...';
                    btnIcon.classList.add('hidden');
                    loadingSpinner.classList.remove('hidden');
                    submitBtn.classList.add('opacity-75', 'cursor-not-allowed');

                    // Get form data
                    const formData = new FormData(form);
                    const data = Object.fromEntries(formData.entries());

                    // Send AJAX request
                    fetch(APP_URL + '/professional/onboarding', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => {
                        return response.json();
                    })
                    .then(data => {
                        // Handle success
                        if (data.success) {
                            // Show success message
                            showNotification(data.message, 'success');

                            // Clear form
                            form.reset();

                            // Reset password strength meter
                            strengthBars.forEach(bar => bar.classList.add('hidden'));

                            // Redirect to step 2 after 2 seconds
                            setTimeout(() => {
                                if (data.redirect) {
                                    window.location.href = data.redirect;
                                }
                            }, 2000);
                        } else {
                            // Handle case where email already exists - redirect to login
                            if (data.redirect && !data.success) {
                                showNotification(data.message, 'info');
                                setTimeout(() => {
                                    window.location.href = data.redirect;
                                }, 2000);
                            } else {
                                // Handle other server-side validation errors
                                showNotification(data.message || 'Registration failed. Please try again.', 'error');
                            }
                        }
                    })
                    .catch(error => {
                        // Handle error
                        console.error('Error:', error);

                        // Parse error response if available
                        if (error.response) {
                            error.response.json().then(data => {
                                if (data.errors) {
                                    // Show validation errors
                                    const errorMessages = Object.values(data.errors).flat();
                                    errorMessages.forEach(message => {
                                        showNotification(message, 'error');
                                    });
                                } else if (data.message) {
                                    showNotification(data.message, 'error');
                                } else {
                                    showNotification('Registration failed. Please try again.', 'error');
                                }
                            }).catch(() => {
                                showNotification('Network error. Please check your connection and try again.', 'error');
                            });
                        } else if (error.message) {
                            // Handle network errors or other exceptions
                            showNotification(error.message, 'error');
                        } else {
                            showNotification('Registration failed. Please try again.', 'error');
                        }
                    })
                    .finally(() => {
                        // Reset button state
                        submitBtn.disabled = false;
                        btnText.textContent = 'Create Secure Account';
                        btnIcon.classList.remove('hidden');
                        loadingSpinner.classList.add('hidden');
                        submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                    });
                });
            });
        </script>
        <script src="{{ asset('js/functions.js') }}"></script>
    </body>
</html>
