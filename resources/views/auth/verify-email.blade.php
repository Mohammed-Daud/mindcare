<!DOCTYPE html>
<html class="light" lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Patient Email Verification - MindfulCare</title>
        <link href="https://fonts.googleapis.com" rel="preconnect"/>
        <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
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
                            "background-light": "#f6f8f8",
                            "background-dark": "#102022",
                        },
                        fontFamily: {
                            "display": ["Manrope", "sans-serif"]
                        },
                        borderRadius: {
                            "DEFAULT": "0.25rem",
                            "lg": "0.5rem",
                            "xl": "0.75rem",
                            "2xl": "1rem",
                            "full": "9999px"
                        },
                    },
                },
            }
        </script>
    </head>
    <body class="bg-background-light dark:bg-background-dark text-[#111718] dark:text-[#e0e0e0] font-display min-h-screen flex flex-col antialiased selection:bg-primary/30">
        <!-- Top Navigation -->
        <header class="w-full bg-white dark:bg-[#152628] border-b border-[#eff3f4] dark:border-[#1e3436]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-primary/20 flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined" style="font-size: 20px;">spa</span>
                        </div>
                        <span class="font-bold text-lg tracking-tight text-[#111718] dark:text-white">MindfulCare</span>
                    </div>
                    <!-- Optional: Help/Contact Link -->
                    <a class="text-sm font-medium text-slate-500 hover:text-primary dark:text-slate-400 transition-colors" href="#">
                    Need Help?
                    </a>
                </div>
            </div>
        </header>
        <!-- Main Content Area -->
        <main class="flex-grow flex flex-col items-center justify-center px-4 py-12 sm:px-6 lg:px-8 relative overflow-hidden">
            <!-- Decorative Background Elements -->
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-primary/5 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-teal-500/5 rounded-full blur-3xl pointer-events-none"></div>
            <div class="w-full max-w-md space-y-8 relative z-10">
                <!-- Central Card -->
                <div class="bg-white dark:bg-[#152628] rounded-2xl shadow-lg border border-slate-100 dark:border-[#1e3436] p-8 text-center sm:p-10">
                    <!-- Icon -->
                    <div class="mx-auto flex items-center justify-center w-20 h-20 rounded-full bg-[#f0fafa] dark:bg-[#1a383b] mb-6">
                        <span class="material-symbols-outlined text-primary" style="font-size: 40px; font-variation-settings: 'FILL' 1;">mark_email_read</span>
                    </div>
                    <!-- Heading & Body -->
                    <h2 class="text-2xl font-bold text-[#111718] dark:text-white mb-3">
                        Verify your email
                    </h2>
                    <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-1">
                        We've sent a secure confirmation link to:
                    </p>
                    <p class="text-[#111718] dark:text-white font-semibold text-base mb-6 break-words">
                        {{ auth()->user()->email }}
                    </p>
                    <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-8">
                        To ensure your privacy and secure your account, please click the link in the email to complete your registration.
                    </p>
                    <!-- Action Button -->
                    <div class="space-y-4">
                        <button id="resendBtn" class="w-full flex items-center justify-center py-3 px-4 rounded-xl shadow-sm text-sm font-bold text-[#102022] bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-200" type="button">
                            <span id="btnText">
                                <span class="material-symbols-outlined mr-2" style="font-size: 20px;">
                                    send
                                </span>
                                Resend Verification Email
                            </span>
                            <div id="loadingSpinner" class="hidden ml-2">
                                <svg class="animate-spin h-5 w-5 text-[#102022]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                        </button>
                        <!-- Spam Note -->
                        <div class="text-xs text-slate-500 dark:text-slate-400">
                            <p>Don't see it? Check your spam folder or junk mail.</p>
                        </div>
                    </div>
                </div>
                <!-- Security & Navigation Panel -->
                <div class="bg-white dark:bg-[#152628] rounded-xl border border-slate-100 dark:border-[#1e3436] p-5 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="bg-emerald-50 dark:bg-emerald-900/20 p-2 rounded-lg text-emerald-600 dark:text-emerald-400">
                            <span class="material-symbols-outlined" style="font-size: 20px;">lock</span>
                        </div>
                        <div class="text-left">
                            <p class="text-sm font-bold text-[#111718] dark:text-white">Secure &amp; Private</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Your data is encrypted.</p>
                        </div>
                    </div>
                    <a class="group flex items-center text-sm font-bold text-slate-600 dark:text-slate-300 hover:text-[#111718] dark:hover:text-white transition-colors" href="{{ route('login') }}">
                        Return to Sign In
                        <span class="material-symbols-outlined ml-1 transition-transform group-hover:translate-x-1" style="font-size: 18px;">arrow_forward</span>
                    </a>
                </div>
            </div>
        </main>
        <!-- Simple Footer -->
        <footer class="py-8 bg-white dark:bg-[#152628] border-t border-[#eff3f4] dark:border-[#1e3436]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center justify-center gap-4">
                <p class="text-slate-500 dark:text-slate-400 text-sm text-center">
                    © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </p>
                <div class="flex gap-6 text-sm text-slate-400 dark:text-slate-500">
                    <a class="hover:text-slate-600 dark:hover:text-slate-300" href="#">Privacy Policy</a>
                    <a class="hover:text-slate-600 dark:hover:text-slate-300" href="#">Terms of Service</a>
                </div>
            </div>
        </footer>
    </body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const resendBtn = document.getElementById('resendBtn');
            const btnText = document.getElementById('btnText');
            const loadingSpinner = document.getElementById('loadingSpinner');

            resendBtn.addEventListener('click', function() {
                // Show loading state
                resendBtn.disabled = true;
                btnText.innerHTML = `
                    <span class="material-symbols-outlined mr-2" style="font-size: 20px;">
                        hourglass_empty
                    </span>
                    Sending...
                `;
                loadingSpinner.classList.remove('hidden');

                fetch("{{ route('verification.send') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    }
                })
                .then(async (response) => {
                    const json = await response.json();
                    console.log('Resend response:', json);

                    if (!response.ok) {
                        if (json.errors) {
                            Object.values(json.errors).flat().forEach(msg => showNotification(msg, 'error'));
                        } else if (json.message) {
                            showNotification(json.message, 'error');
                        } else {
                            showNotification('Failed to resend verification email. Please try again.', 'error');
                        }
                        throw new Error(json.message || 'Request failed');
                    }
                    return json;
                })
                .then((data) => {
                    showNotification(data.message || 'Verification email sent successfully!', 'success');
                })
                .catch((error) => {
                    console.error('Resend error:', error);
                    if (error.message) {
                        showNotification(error.message, 'error');
                    } else {
                        showNotification('Failed to resend verification email. Please try again.', 'error');
                    }
                })
                .finally(() => {
                    // Reset button state
                    resendBtn.disabled = false;
                    btnText.innerHTML = `
                        <span class="material-symbols-outlined mr-2" style="font-size: 20px;">
                            send
                        </span>
                        Resend Verification Email
                    `;
                    loadingSpinner.classList.add('hidden');
                });
            });
        });
    </script>
    <script src="{{ asset('js/functions.js') }}"></script>
</html>
