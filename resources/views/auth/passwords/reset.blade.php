<!DOCTYPE html>
<html class="light" lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Reset Password - {{ config('app.name') }}</title>
        <link href="https://fonts.googleapis.com" rel="preconnect"/>
        <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;family=Noto+Sans:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
        <script id="tailwind-config">
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        colors: {
                            "primary": "#13daec",
                            "secondary": "#618689",
                            "background-light": "#f6f8f8",
                            "background-dark": "#102022",
                            "surface-light": "#ffffff",
                            "surface-dark": "#1a2c30",
                            "text-main": "#111718",
                            "text-muted": "#618689",
                            "border-light": "#e5e7eb",
                            "border-dark": "#2d3748",
                        },
                        fontFamily: {
                            "display": ["Manrope", "sans-serif"],
                            "body": ["Noto Sans", "sans-serif"],
                        },
                        borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                    },
                },
            }
        </script>
    </head>
    <body class="bg-background-light dark:bg-background-dark font-display antialiased text-text-main">
        <div class="flex flex-col min-h-screen">
            <header class="sticky top-0 z-50 w-full bg-white/80 dark:bg-surface-dark/80 backdrop-blur-md border-b border-gray-100 dark:border-gray-800">
                <div class="flex items-center justify-between px-6 lg:px-20 py-4 max-w-7xl mx-auto w-full">
                    <div class="flex items-center gap-3">
                        <div class="text-primary">
                            <span class="material-symbols-outlined text-3xl">psychology</span>
                        </div>
                        <h2 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white font-display">PsychConsult</h2>
                    </div>
                    <div class="hidden md:flex items-center gap-3">
                        <button class="px-5 py-2 text-sm font-bold text-gray-700 dark:text-gray-200 hover:text-primary transition-colors">
                        Log in
                        </button>
                        <button class="px-5 py-2 text-sm font-bold bg-primary text-gray-900 rounded-lg hover:bg-primary/90 transition-colors shadow-sm">
                        Sign up
                        </button>
                    </div>
                    <button class="md:hidden p-2 text-gray-600 dark:text-gray-300">
                    <span class="material-symbols-outlined">menu</span>
                    </button>
                </div>
            </header>
            <main class="flex-grow flex items-center justify-center p-4 sm:p-6 lg:p-8">
                <div class="w-full max-w-[520px] bg-white dark:bg-surface-dark rounded-xl shadow-xl border border-gray-100 dark:border-gray-800 overflow-hidden relative">
                    <div class="h-1.5 w-full bg-gradient-to-r from-primary/60 via-primary to-primary/60"></div>
                    <div class="p-8 sm:p-10 flex flex-col gap-8">
                        <div class="flex flex-col gap-3 text-center">
                            <div class="w-14 h-14 mx-auto bg-primary/10 rounded-full flex items-center justify-center mb-1">
                                <span class="material-symbols-outlined text-primary text-3xl">password</span>
                            </div>
                            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Set New Password</h1>
                            <p class="text-secondary dark:text-gray-400 text-base leading-relaxed">
                                Create a secure password to protect your account and maintain your privacy.
                            </p>
                        </div>
                        <form id="passwordResetForm" class="flex flex-col gap-6" onsubmit="event.preventDefault();">
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-900 dark:text-gray-200 ml-1" for="new-password">
                                New Password
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <span class="material-symbols-outlined text-gray-400 group-focus-within:text-primary transition-colors">lock</span>
                                    </div>
                                    <input class="block w-full pl-11 pr-12 py-3.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all duration-200" id="new-password" name="password" placeholder="Create new password" required="" type="password" minlength="8" maxlength="128" pattern="(?=.*\d)(?=.*[^a-zA-Z0-9]).{8,}" title="Password must be at least 8 characters long and include at least one number and one special character"/>
                                    <button class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-200" type="button" id="togglePassword">
                                    <span class="material-symbols-outlined">visibility</span>
                                    </button>
                                </div>
                                <!-- Password Strength Meter -->
                                <div class="mt-3 grid grid-cols-4 gap-2" id="strengthMeter">
                                    <div class="h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full">
                                        <div class="w-full h-full bg-red-400 rounded-full hidden"></div>
                                    </div>
                                    <div class="h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full">
                                        <div class="w-full h-full bg-red-400 rounded-full hidden"></div>
                                    </div>
                                    <div class="h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full">
                                        <div class="w-full h-full bg-red-400 rounded-full hidden"></div>
                                    </div>
                                    <div class="h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full">
                                        <div class="w-full h-full bg-red-400 rounded-full hidden"></div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-y-2 mt-4 ml-1">
                                    <div class="flex items-center gap-2 text-xs text-secondary dark:text-gray-400" id="req-length">
                                        <span class="material-symbols-outlined text-sm text-gray-300 dark:text-gray-600" id="check-length">radio_button_unchecked</span>
                                        <span>At least 8 characters</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-xs text-secondary dark:text-gray-400" id="req-number">
                                        <span class="material-symbols-outlined text-sm text-gray-300 dark:text-gray-600" id="check-number">radio_button_unchecked</span>
                                        <span>Includes a number</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-xs text-secondary dark:text-gray-400" id="req-special">
                                        <span class="material-symbols-outlined text-sm text-gray-300 dark:text-gray-600" id="check-special">radio_button_unchecked</span>
                                        <span>Special character</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-xs text-secondary dark:text-gray-400" id="req-uppercase">
                                        <span class="material-symbols-outlined text-sm text-gray-300 dark:text-gray-600" id="check-uppercase">radio_button_unchecked</span>
                                        <span>Uppercase letter</span>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-900 dark:text-gray-200 ml-1" for="confirm-password">
                                Confirm New Password
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <span class="material-symbols-outlined text-gray-400 group-focus-within:text-primary transition-colors">lock_person</span>
                                    </div>
                                    <input class="block w-full pl-11 pr-12 py-3.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all duration-200" id="confirm-password" name="password_confirmation" placeholder="Confirm your password" required="" type="password"/>
                                </div>
                            </div>
                            <button id="resetBtn" class="w-full flex items-center justify-center gap-2 bg-primary hover:bg-primary/90 text-gray-900 font-bold py-4 px-4 rounded-lg shadow-md shadow-primary/20 transition-all duration-200 transform hover:-translate-y-0.5 mt-2" type="submit">
                                <span id="btnText">
                                    <span>Update Password</span>
                                    <span class="material-symbols-outlined">verified_user</span>
                                </span>
                                <div id="loadingSpinner" class="hidden ml-2">
                                    <svg class="animate-spin h-5 w-5 text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </div>
                            </button>
                        </form>
                        <div class="text-center">
                            <a class="inline-flex items-center gap-1.5 text-secondary hover:text-primary dark:text-gray-400 dark:hover:text-primary text-sm font-semibold transition-colors duration-200 group" href="#">
                            <span class="material-symbols-outlined text-lg group-hover:-translate-x-1 transition-transform">arrow_back</span>
                            Back to login
                            </a>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800/50 py-4 px-8 border-t border-gray-100 dark:border-gray-800 flex items-center justify-center gap-3 text-[11px] text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wider">
                        <span class="material-symbols-outlined text-lg text-primary/70">verified</span>
                        <span>Protected by multi-layer encryption</span>
                    </div>
                </div>
            </main>
            <div class="hidden lg:block fixed bottom-0 left-0 p-10 opacity-30 pointer-events-none z-[-1]">
                <div class="w-72 h-72 bg-primary/20 rounded-full blur-[100px]"></div>
            </div>
            <div class="hidden lg:block fixed top-20 right-0 p-10 opacity-30 pointer-events-none z-[-1]">
                <div class="w-[500px] h-[500px] bg-secondary/10 rounded-full blur-[120px]"></div>
            </div>
        </div>
    </body>
    <script>
        // Password requirements from centralized service
        const passwordRequirements = @json(\App\Services\PasswordValidationService::getRequirements());

        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('new-password');
            const confirmPasswordInput = document.getElementById('confirm-password');
            const togglePassword = document.getElementById('togglePassword');
            const passwordResetForm = document.getElementById('passwordResetForm');
            const resetBtn = document.getElementById('resetBtn');
            const btnText = document.getElementById('btnText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const strengthMeter = document.getElementById('strengthMeter');
            const strengthBars = strengthMeter.querySelectorAll('.bg-red-400');

            // Requirement checkboxes configuration
            const requirementCheckboxes = {
                length: true,
                number: true,
                special: true,
                uppercase: true
            };

            // Initialize password strength checker with reusable function
            initPasswordStrengthChecker(passwordInput, {
                strengthBars: strengthBars,
                requirementCheckboxes: requirementCheckboxes
            });

            // Form submission with AJAX
            passwordResetForm.addEventListener('submit', function() {
                // Get form data
                const formData = new FormData(passwordResetForm);
                const data = {
                    token: formData.get('token'),
                    email: formData.get('email'),
                    password: formData.get('password'),
                    password_confirmation: formData.get('password_confirmation')
                };

                // Show loading state
                resetBtn.disabled = true;
                btnText.innerHTML = `
                    <span>Updating...</span>
                    <span class="material-symbols-outlined">hourglass_empty</span>
                `;
                loadingSpinner.classList.remove('hidden');

                fetch("{{ url('/password/reset') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify(data)
                })
                .then(async (response) => {
                    const json = await response.json();
                    console.log('Password reset response:', json);

                    if (!response.ok) {
                        if (json.errors) {
                            Object.values(json.errors).flat().forEach(msg => showNotification(msg, 'error'));
                        } else if (json.message) {
                            showNotification(json.message, 'error');
                        } else {
                            showNotification('Failed to reset password. Please try again.', 'error');
                        }
                        throw new Error(json.message || 'Request failed');
                    }
                    return json;
                })
                .then((data) => {
                    showNotification(data.message || 'Password reset successful!', 'success');

                    // Redirect to login after 2 seconds
                    setTimeout(() => {
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        } else {
                            window.location.href = '{{ route("login") }}';
                        }
                    }, 2000);
                })
                .catch((error) => {
                    console.error('Password reset error:', error);
                    if (error.message) {
                        showNotification(error.message, 'error');
                    } else {
                        showNotification('Failed to reset password. Please try again.', 'error');
                    }
                })
                .finally(() => {
                    // Reset button state
                    resetBtn.disabled = false;
                    btnText.innerHTML = `
                        <span>Update Password</span>
                        <span class="material-symbols-outlined">verified_user</span>
                    `;
                    loadingSpinner.classList.add('hidden');
                });
            });
        });
    </script>
    <script src="{{ asset('js/functions.js') }}"></script>
</html>

<!-- <form method="POST" action="{{ url('/password/reset') }}">
    @csrf


    <input type="hidden" name="user_type" value="{{ request()->query('usertype', 'user') }}">

    <div class="form-group">
        <label for="password">New Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        @error('password')
            <span class="error-message" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password-confirm">Confirm Password</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
    </div>

    <button type="submit" class="btn-primary">
        Reset Password
    </button>
</form> -->

