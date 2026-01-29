<!DOCTYPE html>
<html class="light" lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Patient Registration - MindfulCare</title>
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
        <script id="tailwind-config">
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        colors: {
                            "primary": "#13daec",
                            "primary-dark": "#0eaebd", // Darker shade for text contrast if needed
                            "background-light": "#f6f8f8",
                            "background-dark": "#102022",
                            "surface-light": "#ffffff",
                            "surface-dark": "#1a2c2e",
                            "text-main-light": "#111718",
                            "text-main-dark": "#e0e6e7",
                            "text-muted-light": "#618689",
                            "text-muted-dark": "#8a9ea0",
                        },
                        fontFamily: {
                            "display": ["Manrope", "sans-serif"]
                        },
                        borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "2xl": "1rem", "full": "9999px"},
                    },
                },
            }
        </script>
        <style>
            /* Custom scrollbar for better aesthetics */
            ::-webkit-scrollbar {
            width: 8px;
            }
            ::-webkit-scrollbar-track {
            background: transparent;
            }
            ::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 20px;
            }
            .form-checkbox:checked {
            background-color: #13daec;
            border-color: #13daec;
            }
            /* Gradient text utility */
            .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            background-image: linear-gradient(to right, #111718, #13daec);
            }
            .dark .text-gradient {
            background-image: linear-gradient(to right, #ffffff, #13daec);
            }
        </style>
    </head>
    <body class="font-display bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark min-h-screen flex flex-col">
        <!-- Top Navigation -->
        <header class="flex items-center justify-between border-b border-gray-200 dark:border-gray-800 px-6 py-4 lg:px-12 bg-surface-light dark:bg-surface-dark relative z-10">
            <div class="flex items-center gap-3">
                <div class="size-8 text-primary">
                    <svg class="w-full h-full" fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_6_330)">
                            <path clip-rule="evenodd" d="M24 0.757355L47.2426 24L24 47.2426L0.757355 24L24 0.757355ZM21 35.7574V12.2426L9.24264 24L21 35.7574Z" fill="currentColor" fill-rule="evenodd"></path>
                        </g>
                        <defs>
                            <clippath id="clip0_6_330">
                                <rect fill="white" height="48" width="48"></rect>
                            </clippath>
                        </defs>
                    </svg>
                </div>
                <h2 class="text-xl font-bold tracking-tight">MindfulCare</h2>
            </div>
            <div class="hidden sm:flex items-center gap-4">
                <span class="text-sm font-medium text-text-muted-light dark:text-text-muted-dark">Already have an account?</span>
                <a href="{{ route('login') }}" class="text-sm font-bold text-primary-dark dark:text-primary hover:text-primary dark:hover:text-white transition-colors">
                    Log In
                </a>
            </div>
        </header>
        <!-- Main Content: Split Layout -->
        <main class="flex-1 flex flex-col lg:flex-row h-full">
            <!-- Left Side: Visuals & Value Prop -->
            <div class="hidden lg:flex lg:w-5/12 xl:w-1/2 bg-surface-light dark:bg-background-dark relative flex-col justify-center p-12 overflow-hidden">
                <!-- Background Elements -->
                <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-primary/10 via-background-light to-white dark:from-background-dark dark:via-background-dark dark:to-surface-dark z-0"></div>
                <!-- Abstract shapes for calmness -->
                <div class="absolute top-1/4 -left-20 w-96 h-96 bg-primary/20 rounded-full blur-3xl opacity-60"></div>
                <div class="absolute bottom-1/4 -right-20 w-80 h-80 bg-blue-300/20 dark:bg-blue-900/20 rounded-full blur-3xl opacity-60"></div>
                <div class="relative z-10 max-w-lg mx-auto flex flex-col gap-8">
                    <div class="w-full aspect-[4/3] rounded-2xl overflow-hidden shadow-xl" data-alt="Calm nature scene with soft sunlight through leaves" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAGvHf1O6OEwNzbR6GUKvtI13QN1wT6lXszA94Jl41F-EMLUVMtposCljDkppxV11kUIr9DiIYwTgU27vtecQmMwi0bprYxJ5aa6p5dRBb44SowXqKb4R4ICPKaGJavN8yVWxbN8k6yCj0s1TEVskBx-fN4EbbFA4gOOKJu6S-fjQmDBx8P8m7DP6YvhLuat_qRFGLeof0wwOFPazGI32T4ysnQV3Jl7nUL0W2bBMHMCh525elEj9R5hGIJc8qlnLHiIFmbyr_ouhN6'); background-size: cover; background-position: center;">
                        <div class="w-full h-full bg-gradient-to-t from-black/40 to-transparent"></div>
                    </div>
                    <div class="space-y-4">
                        <h1 class="text-4xl font-bold leading-tight text-text-main-light dark:text-white">
                            Begin your journey to wellness today.
                        </h1>
                        <p class="text-lg text-text-muted-light dark:text-text-muted-dark leading-relaxed">
                            Join thousands of patients finding peace and professional support in a safe, encrypted environment. Your mental health is our priority.
                        </p>
                        <div class="flex items-center gap-4 pt-4">
                            <div class="flex -space-x-3">
                                <img alt="User portrait" class="w-10 h-10 rounded-full border-2 border-white dark:border-surface-dark object-cover" data-alt="Portrait of a smiling young woman" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD5Kwz7F8F2ol-Ot9AIRedZrTg5kJmhwKesMFKsYqTXc-mfdJcu9Ri7s7_M2HHFzTP_6gjUwFAf3YFoF54ZgBsDhyvnDcpCwTDf9iELgUgxwCn-e1Ej6SDxGVdNXKwXMtXZAMOjv3_4qP54qgm_CF5ybf5f3c9P4u1SRdaxf1ftiVY9CxUSNrnCFvqePJfZgY-TK4tCJArxZAQA4ih37r-v5gRnDJDcDII9kNe5Tqsc3Kd25-WC_kzXZZu--w1-jWOO8xZtW22GVwCo"/>
                                <img alt="User portrait" class="w-10 h-10 rounded-full border-2 border-white dark:border-surface-dark object-cover" data-alt="Portrait of a focused man" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD8svHqgyjiniHAt-LOorNh8emEHvw-8vWitbhUaIxTsRrs3Ph1tLw14tU8V8wpCRTrIk954dt4EFvbfbOdLnn2uwkVz8tW9ihiLL_jLM2nLSoVd0ju-b235Fh6N3cJrjHO6BZmGwe7iQ9zcfLrgaYWWzE3XyT9KYOB2hdFNy-2IOO_56wcXiydT0eUurWfJZfd9CMHNy1zLLbrMQhY-90SaIV0qrq6DKNQ-BA1fBkoM5ZWQMASM_-2m69i_m0MOo9liY39lI1ooa1S"/>
                                <img alt="User portrait" class="w-10 h-10 rounded-full border-2 border-white dark:border-surface-dark object-cover" data-alt="Portrait of a smiling man with glasses" src="https://lh3.googleusercontent.com/aida-public/AB6AXuARQxUPrCn_dDaWtSLyQ_x6pEZRSE5JP7_2BR7k3s_ME9aRXV14R662qqeKKTQTuSbevSvptGYD9HdTXmvoX4CdgnKWF7jZyxusuYo-TA6EYF1-Pk0p5PAAYJjAnKv9l3W5Ycj7AZH0sEbrn60gRp26phVll4q6gLIxTRHKDwKSiGggFw9aJ91Y17s8xSEBZ45xWidiaF0vhIM7_w81b_0J2Kd23QPuZgIqlFP1cpPps1GY5X43uE3n4VM79yL6zHG6heHvTz1RlkX9"/>
                                <div class="w-10 h-10 rounded-full border-2 border-white dark:border-surface-dark bg-primary/20 flex items-center justify-center text-xs font-bold text-primary-dark dark:text-primary">
                                    +2k
                                </div>
                            </div>
                            <span class="text-sm font-medium text-text-muted-light dark:text-text-muted-dark">Trusted by patients worldwide</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right Side: Registration Form -->
            <div class="flex-1 flex flex-col items-center justify-center p-6 lg:p-12 xl:p-24 overflow-y-auto">
                <div class="w-full max-w-[520px] bg-surface-light dark:bg-surface-dark rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 p-8 sm:p-10">
                    <!-- Form Header -->
                    <div class="mb-8 text-center sm:text-left">
                        <h2 class="text-2xl sm:text-3xl font-bold text-text-main-light dark:text-white mb-2">Create your account</h2>
                        <p class="text-text-muted-light dark:text-text-muted-dark">
                            Your safe space for professional mental health care.
                        </p>
                    </div>
                    <form class="flex flex-col gap-5" onsubmit="event.preventDefault();">
                        <!-- Name Field -->
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-text-main-light dark:text-gray-300" for="fullname">Full Name</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-gray-400 text-[20px]">person</span>
                                </div>
                                <input class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-background-dark text-text-main-light dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all shadow-sm text-base" id="fullname" name="fullname" placeholder="e.g. Alex Smith" type="text" required minlength="2" maxlength="50" pattern="[A-Za-z\s]+" title="Please enter your full name (letters only, 2-50 characters)"/>
                            </div>
                        </div>
                        <!-- Email Field -->
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-text-main-light dark:text-gray-300" for="email">Email Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-gray-400 text-[20px]">mail</span>
                                </div>
                                <input class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-background-dark text-text-main-light dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all shadow-sm text-base" id="email" name="email" placeholder="name@example.com" type="email" required title="Please enter a valid email address"/>
                            </div>
                        </div>
                        <!-- Pronouns (Optional) -->
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-text-main-light dark:text-gray-300 flex justify-between" for="pronouns">
                            Preferred Pronouns <span class="text-text-muted-light dark:text-gray-500 font-normal text-xs uppercase tracking-wider mt-1">Optional</span>
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-gray-400 text-[20px]">face</span>
                                </div>
                                <select class="w-full pl-10 pr-10 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-background-dark text-text-main-light dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all shadow-sm appearance-none cursor-pointer" id="pronouns" name="pronouns">
                                    <option disabled="" selected="" value="">Select pronouns</option>
                                    <option value="she/her">She/Her</option>
                                    <option value="he/him">He/Him</option>
                                    <option value="they/them">They/Them</option>
                                    <option value="other">Prefer not to say / Other</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300">
                                    <span class="material-symbols-outlined text-[24px]">arrow_drop_down</span>
                                </div>
                            </div>
                        </div>
                        <!-- Password Field -->
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-text-main-light dark:text-gray-300" for="password">Create Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-gray-400 text-[20px]">lock</span>
                                </div>
                                <input class="w-full pl-10 pr-12 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-background-dark text-text-main-light dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all shadow-sm text-base" id="password" name="password" placeholder="Min. 8 characters" type="password" required minlength="8" maxlength="128" pattern="(?=.*\d)(?=.*[^a-zA-Z0-9]).{8,}" title="Password must be at least 8 characters long and include at least one number and one special character"/>
                                <button class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 cursor-pointer" type="button">
                                <span class="material-symbols-outlined text-[20px]">visibility_off</span>
                                </button>
                            </div>
                            <!-- Password Strength Meter -->
                            <div class="flex gap-1 mt-1 h-1">
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
                            <p class="text-xs text-text-muted-light dark:text-gray-500 mt-1">Must contain at least 8 characters, including a number and symbol.</p>
                        </div>
                        <!-- Terms Checkbox -->
                        <div class="flex items-start gap-3 mt-2">
                            <div class="flex h-6 items-center">
                                <input class="h-5 w-5 rounded border-gray-300 dark:border-gray-600 text-primary focus:ring-primary/20 dark:bg-background-dark dark:checked:bg-primary cursor-pointer" id="terms" name="terms" type="checkbox" required title="You must agree to the Terms of Service and Privacy Policy to continue"/>
                            </div>
                            <div class="text-sm leading-6">
                                <label class="font-medium text-text-main-light dark:text-gray-300" for="terms">I agree to the <a class="text-primary-dark dark:text-primary hover:underline" href="#">Terms of Service</a> and acknowledge the <a class="text-primary-dark dark:text-primary hover:underline" href="#">Privacy Policy</a>.</label>
                                <p class="text-gray-500 dark:text-gray-500 text-xs">Your data is encrypted and handled with strict confidentiality.</p>
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <button class="mt-4 w-full flex items-center justify-center gap-2 bg-primary hover:bg-[#0fd0e2] active:bg-[#0cc6d8] text-text-main-light font-bold py-3.5 px-6 rounded-lg transition-colors shadow-md shadow-primary/20 focus:outline-none focus:ring-4 focus:ring-primary/20 group" type="submit" id="submitBtn">
                            <span id="btnText">Create Secure Account</span>
                            <span id="btnIcon" class="material-symbols-outlined text-[20px] transition-transform group-hover:translate-x-1">arrow_forward</span>
                            <div id="loadingSpinner" class="hidden">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                        </button>
                    </form>
                    <!-- Footer / Login Link Mobile -->
                    <div class="mt-8 text-center lg:hidden">
                        <p class="text-sm text-text-muted-light dark:text-text-muted-dark">
                            Already have an account?
                            <a class="font-bold text-primary-dark dark:text-primary hover:underline" href="{{ route('login') }}">Log in</a>
                        </p>
                    </div>
                    <!-- Trust Badges -->
                    <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-800 flex items-center justify-center gap-6 opacity-70 grayscale hover:grayscale-0 transition-all">
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-green-600 text-[18px]">verified_user</span>
                            <span class="text-xs font-bold text-gray-500 dark:text-gray-400">HIPAA Compliant</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-blue-600 text-[18px]">lock</span>
                            <span class="text-xs font-bold text-gray-500 dark:text-gray-400">256-bit Encryption</span>
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
                const strengthBars = document.querySelectorAll('.flex.gap-1.mt-1.h-1 > div > div');

                // Initialize password strength checker with reusable function
                initPasswordStrengthChecker(passwordInput, {
                    strengthBars: strengthBars
                });
            });

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
                fetch(APP_URL + '/client/register', {
                    method: 'POST',
                    // response type should be json
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    // if (!response.ok) {
                    //     throw new Error('Network response was not ok');
                    // }
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

                        // Redirect to email verification page after 2 seconds
                        setTimeout(() => {
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            } else {
                                window.location.href = APP_URL + '/email/verify';
                            }
                        }, 2000);
                    } else {
                        // Handle server-side validation errors
                        showNotification(data.message || 'Registration failed. Please try again.', 'error');
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
        </script>
        <script src="{{ asset('js/functions.js') }}"></script>
    </body>
</html>
