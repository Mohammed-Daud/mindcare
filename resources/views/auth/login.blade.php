

<!-- <form method="POST" action="">
    @csrf

    <div class="form-group">
        <label for="email">Email Address</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <span class="error-message" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        @error('password')
            <span class="error-message" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                Remember Me
            </label>
        </div>
    </div>

    <button type="submit" class="btn-primary">
        Login
    </button>
</form>

<div class="auth-links">
    <a href="{{ route('password.request') }}">
        Forgot Your Password?
    </a>
    <br>

    <br>

</div>
</div>
</div> -->


<!DOCTYPE html>
<html class="light" lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Psychiatric Care Login</title>
        <link href="https://fonts.googleapis.com" rel="preconnect"/>
        <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
        <script>
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        colors: {
                            "primary": "#13daec",
                            "background-light": "#f6f8f8",
                            "background-dark": "#102022",
                            "text-main": "#0d1a1b",
                            "text-muted": "#4c939a",
                            "surface-light": "#ffffff",
                            "surface-dark": "#1a2c2e",
                            "border-light": "#e7f2f3",
                            "border-dark": "#2a3c3e",
                        },
                        fontFamily: {
                            "display": ["Manrope", "sans-serif"]
                        },
                        borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "2xl": "1rem", "full": "9999px"},
                    },
                },
            }
        </script>
    </head>
    <body class="bg-background-light dark:bg-background-dark font-display text-text-main dark:text-white transition-colors duration-200">
        <div class="relative flex min-h-screen w-full flex-col overflow-hidden">
            <!-- Header -->
            <header class="flex items-center justify-between whitespace-nowrap border-b border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark px-10 py-3 z-10 relative shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="size-8 text-primary">
                        <svg class="w-full h-full" fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_6_543)">
                                <path d="M42.1739 20.1739L27.8261 5.82609C29.1366 7.13663 28.3989 10.1876 26.2002 13.7654C24.8538 15.9564 22.9595 18.3449 20.6522 20.6522C18.3449 22.9595 15.9564 24.8538 13.7654 26.2002C10.1876 28.3989 7.13663 29.1366 5.82609 27.8261L20.1739 42.1739C21.4845 43.4845 24.5355 42.7467 28.1133 40.548C30.3042 39.2016 32.6927 37.3073 35 35C37.3073 32.6927 39.2016 30.3042 40.548 28.1133C42.7467 24.5355 43.4845 21.4845 42.1739 20.1739Z" fill="currentColor"></path>
                                <path clip-rule="evenodd" d="M7.24189 26.4066C7.31369 26.4411 7.64204 26.5637 8.52504 26.3738C9.59462 26.1438 11.0343 25.5311 12.7183 24.4963C14.7583 23.2426 17.0256 21.4503 19.238 19.238C21.4503 17.0256 23.2426 14.7583 24.4963 12.7183C25.5311 11.0343 26.1438 9.59463 26.3738 8.52504C26.5637 7.64204 26.4411 7.31369 26.4066 7.24189C26.345 7.21246 26.143 7.14535 25.6664 7.1918C24.9745 7.25925 23.9954 7.5498 22.7699 8.14278C20.3369 9.32007 17.3369 11.4915 14.4142 14.4142C11.4915 17.3369 9.32007 20.3369 8.14278 22.7699C7.5498 23.9954 7.25925 24.9745 7.1918 25.6664C7.14534 26.143 7.21246 26.345 7.24189 26.4066ZM29.9001 10.7285C29.4519 12.0322 28.7617 13.4172 27.9042 14.8126C26.465 17.1544 24.4686 19.6641 22.0664 22.0664C19.6641 24.4686 17.1544 26.465 14.8126 27.9042C13.4172 28.7617 12.0322 29.4519 10.7285 29.9001L21.5754 40.747C21.6001 40.7606 21.8995 40.931 22.8729 40.7217C23.9424 40.4916 25.3821 39.879 27.0661 38.8441C29.1062 37.5904 31.3734 35.7982 33.5858 33.5858C35.7982 31.3734 37.5904 29.1062 38.8441 27.0661C39.879 25.3821 40.4916 23.9425 40.7216 22.8729C40.931 21.8995 40.7606 21.6001 40.747 21.5754L29.9001 10.7285ZM29.2403 4.41187L43.5881 18.7597C44.9757 20.1473 44.9743 22.1235 44.6322 23.7139C44.2714 25.3919 43.4158 27.2666 42.252 29.1604C40.8128 31.5022 38.8165 34.012 36.4142 36.4142C34.012 38.8165 31.5022 40.8128 29.1604 42.252C27.2666 43.4158 25.3919 44.2714 23.7139 44.6322C22.1235 44.9743 20.1473 44.9757 18.7597 43.5881L4.41187 29.2403C3.29027 28.1187 3.08209 26.5973 3.21067 25.2783C3.34099 23.9415 3.8369 22.4852 4.54214 21.0277C5.96129 18.0948 8.43335 14.7382 11.5858 11.5858C14.7382 8.43335 18.0948 5.9613 21.0277 4.54214C22.4852 3.8369 23.9415 3.34099 25.2783 3.21067C26.5973 3.08209 28.1187 3.29028 29.2403 4.41187Z" fill="currentColor" fill-rule="evenodd"></path>
                            </g>
                            <defs>
                                <clippath id="clip0_6_543">
                                    <rect fill="white" height="48" width="48"></rect>
                                </clippath>
                            </defs>
                        </svg>
                    </div>
                    <h2 class="text-text-main dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">Mindful Care</h2>
                </div>
                <div class="flex flex-1 justify-end gap-8">
                    <div class="hidden md:flex items-center gap-9">
                        <a class="text-text-main dark:text-gray-300 hover:text-primary transition-colors text-sm font-medium" href="#">Help Center</a>
                        <a class="text-text-main dark:text-gray-300 hover:text-primary transition-colors text-sm font-medium" href="#">Privacy Policy</a>
                    </div>
                    <button class="flex min-w-[84px] cursor-pointer items-center justify-center rounded-lg h-9 px-4 bg-transparent border border-border-dark/20 hover:bg-primary/10 text-text-main dark:text-white dark:border-border-dark text-sm font-bold leading-normal transition-colors">
                    <span class="truncate">Contact Support</span>
                    </button>
                </div>
            </header>
            <!-- Main Content Area -->
            <main class="flex flex-1 flex-col md:flex-row h-full">
                <!-- Left Side: Hero / Illustration -->
                <div class="hidden md:flex md:w-5/12 lg:w-1/2 relative bg-[#e0f2f4] dark:bg-[#0c1a1c] items-center justify-center p-12 overflow-hidden">
                    <!-- Abstract blobs for calm feeling -->
                    <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-primary/20 rounded-full blur-[100px]"></div>
                    <div class="absolute bottom-[-10%] right-[-10%] w-[400px] h-[400px] bg-[#4c939a]/20 rounded-full blur-[80px]"></div>
                    <div class="relative z-10 flex flex-col gap-6 max-w-md">
                        <h1 class="text-4xl lg:text-5xl font-extrabold text-text-main dark:text-white tracking-tight leading-[1.1]">
                            Healing begins with a safe space.
                        </h1>
                        <p class="text-lg text-text-muted dark:text-gray-400 leading-relaxed">
                            Access your secure portal to connect with your care team, manage appointments, and track your mental wellness journey.
                        </p>
                        <div class="mt-8 flex items-center gap-4 bg-white/50 dark:bg-black/20 backdrop-blur-sm p-4 rounded-xl border border-white/40 dark:border-white/10 max-w-xs">
                            <div class="bg-primary/20 p-2 rounded-full text-primary">
                                <span class="material-symbols-outlined">verified_user</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-text-main dark:text-white">HIPAA Compliant</span>
                                <span class="text-xs text-text-muted dark:text-gray-400">Your data is fully encrypted</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right Side: Login Form -->
                <div class="flex flex-1 items-center justify-center p-6 md:p-12 lg:p-24 bg-surface-light dark:bg-surface-dark">
                    <div class="w-full max-w-[480px] flex flex-col gap-8">
                        <!-- Form Header -->
                        <div class="flex flex-col gap-2">
                            <h2 class="text-3xl font-bold text-text-main dark:text-white tracking-tight">Welcome Back</h2>
                            <p class="text-text-muted dark:text-gray-400">Please select your role to continue securely.</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}" id="loginForm" class="flex flex-col gap-5">
                            <!-- Role Selector (Segmented Control) -->
                            <div class="flex flex-col gap-3">
                                <label class="text-sm font-semibold text-text-main dark:text-white">I am a...</label>
                                <div class="grid grid-cols-3 gap-2 p-1 bg-background-light dark:bg-background-dark rounded-xl border border-border-light dark:border-border-dark">
                                    <!-- Patient Role -->
                                    <label class="group cursor-pointer relative flex flex-col items-center justify-center py-3 px-2 rounded-lg transition-all duration-200 hover:bg-white dark:hover:bg-white/5">
                                        <input {{ $user_type != \App\Models\User::TYPE_DOCTOR ? 'checked' : '' }} class="peer sr-only" name="role" type="radio" value="{{ \App\Models\User::TYPE_CLIENT }}"/>
                                        <div class="absolute inset-0 bg-white dark:bg-[#2a3c3e] rounded-lg shadow-sm scale-95 opacity-0 peer-checked:opacity-100 peer-checked:scale-100 transition-all duration-200 border border-transparent peer-checked:border-primary/30"></div>
                                        <span class="material-symbols-outlined relative z-10 text-text-muted peer-checked:text-primary mb-1 transition-colors">favorite</span>
                                        <span class="relative z-10 text-sm font-semibold text-text-muted peer-checked:text-text-main dark:peer-checked:text-white transition-colors">Patient</span>
                                    </label>
                                    <!-- Doctor Role -->
                                    <label class="group cursor-pointer relative flex flex-col items-center justify-center py-3 px-2 rounded-lg transition-all duration-200 hover:bg-white dark:hover:bg-white/5">
                                        <input {{ $user_type == \App\Models\User::TYPE_DOCTOR ? 'checked' : '' }} class="peer sr-only" name="role" type="radio" value="{{ \App\Models\User::TYPE_DOCTOR }}"/>
                                        <div class="absolute inset-0 bg-white dark:bg-[#2a3c3e] rounded-lg shadow-sm scale-95 opacity-0 peer-checked:opacity-100 peer-checked:scale-100 transition-all duration-200 border border-transparent peer-checked:border-primary/30"></div>
                                        <span class="material-symbols-outlined relative z-10 text-text-muted peer-checked:text-primary mb-1 transition-colors">stethoscope</span>
                                        <span class="relative z-10 text-sm font-semibold text-text-muted peer-checked:text-text-main dark:peer-checked:text-white transition-colors">Doctor</span>
                                    </label>
                                    <!-- Admin Role -->
                                    <label class="group cursor-pointer relative flex flex-col items-center justify-center py-3 px-2 rounded-lg transition-all duration-200 hover:bg-white dark:hover:bg-white/5">
                                        <input class="peer sr-only" name="role" type="radio" value="{{ \App\Models\User::TYPE_SUPER_ADMIN }}"/>
                                        <div class="absolute inset-0 bg-white dark:bg-[#2a3c3e] rounded-lg shadow-sm scale-95 opacity-0 peer-checked:opacity-100 peer-checked:scale-100 transition-all duration-200 border border-transparent peer-checked:border-primary/30"></div>
                                        <span class="material-symbols-outlined relative z-10 text-text-muted peer-checked:text-primary mb-1 transition-colors">admin_panel_settings</span>
                                        <span class="relative z-10 text-sm font-semibold text-text-muted peer-checked:text-text-main dark:peer-checked:text-white transition-colors">Admin</span>
                                    </label>
                                </div>
                            </div>
                            <!-- Input Fields -->
                            <label class="flex flex-col gap-2">
                                <span class="text-text-main dark:text-gray-200 text-sm font-medium">Email or Username</span>
                                <div class="relative">
                                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-text-muted">
                                        <span class="material-symbols-outlined" style="font-size: 20px;">mail</span>
                                    </div>
                                    <input value="{{ $email ?? '' }}" class="w-full rounded-xl border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark pl-11 pr-4 py-3.5 text-text-main dark:text-white focus:border-primary focus:ring-1 focus:ring-primary transition-colors placeholder:text-text-muted/60" placeholder="name@example.com" type="email" name="email" required autocomplete="email" autofocus/>
                                </div>
                            </label>
                            <label class="flex flex-col gap-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-text-main dark:text-gray-200 text-sm font-medium">Password</span>
                                    <a class="text-primary text-sm font-semibold hover:text-primary/80 transition-colors" href="{{ route('password.request') }}">Forgot Password?</a>
                                </div>
                                <div class="relative">
                                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-text-muted">
                                        <span class="material-symbols-outlined" style="font-size: 20px;">lock</span>
                                    </div>
                                    <input class="w-full rounded-xl border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark pl-11 pr-12 py-3.5 text-text-main dark:text-white focus:border-primary focus:ring-1 focus:ring-primary transition-colors placeholder:text-text-muted/60" placeholder="••••••••" type="password" name="password" required autocomplete="current-password" id="passwordInput"/>
                                    <button class="absolute right-4 top-1/2 -translate-y-1/2 text-text-muted hover:text-text-main dark:hover:text-white transition-colors" type="button" id="togglePassword">
                                    <span class="material-symbols-outlined" style="font-size: 20px;" id="eyeIcon">visibility_off</span>
                                    </button>
                                </div>
                            </label>
                            <!-- Actions -->
                            <div class="flex flex-col gap-4 mt-2">
                                <button class="flex w-full items-center justify-center rounded-xl bg-primary hover:bg-[#0fbccb] active:bg-[#0daab8] py-4 text-text-main font-bold text-base transition-all shadow-md shadow-primary/20" type="submit" id="loginBtn">
                                <span id="btnText">Log In</span>
                                <div id="loadingSpinner" class="hidden ml-2">
                                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </div>
                                </button>
                                <p class="text-center text-sm text-text-muted dark:text-gray-400">
                                    Don't have an account?
                                    <a class="font-bold text-primary hover:text-primary/80 transition-colors" href="{{ route('client.register') }}">Sign up</a>
                                </p>
                            </div>
                        </form>
                        <!-- Footer Note -->
                        <div class="flex items-center justify-center gap-2 pt-4 border-t border-border-light dark:border-border-dark mt-4">
                            <span class="material-symbols-outlined text-green-500 text-lg">check_circle</span>
                            <span class="text-xs text-text-muted dark:text-gray-500 font-medium">Encrypted End-to-End Connection</span>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <script>
            // Password visibility toggle
            const passwordInput = document.getElementById('passwordInput');
            const togglePassword = document.getElementById('togglePassword');
            const eyeIcon = document.getElementById('eyeIcon');

            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Toggle icon
                if (type === 'password') {
                    eyeIcon.textContent = 'visibility_off';
                } else {
                    eyeIcon.textContent = 'visibility';
                }
            });

            // Form submission with AJAX
            const loginForm = document.getElementById('loginForm');
            const loginBtn = document.getElementById('loginBtn');
            const btnText = document.getElementById('btnText');
            const loadingSpinner = document.getElementById('loadingSpinner');

            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Get form data
                const formData = new FormData(loginForm);
                const data = {
                    role: formData.get('role'),
                    email: formData.get('email'),
                    password: formData.get('password'),
                    remember: formData.get('remember') ? 1 : 0
                };

                // Show loading state
                loginBtn.disabled = true;
                btnText.textContent = 'Logging in...';
                loadingSpinner.classList.remove('hidden');

                fetch("{{ route('login') }}", {
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
                    console.log(json);
                    if (!response.ok) {
                        console.log('response not ok',response);
                        // Handle email verification redirect case
                        if (json.redirect) {
                            showNotification(json.message || 'Please verify your email address.', 'info');
                            setTimeout(() => {
                                window.location.href = json.redirect;
                            }, 2000);
                            return;
                        }

                        if (json.errors) {
                            Object.values(json.errors).flat().forEach(msg => showNotification(msg, 'error'));
                        } else if (json.message) {
                            showNotification(json.message, 'error');
                        }
                        throw new Error(json.message || 'Request failed');
                    }
                    return json;
                })
                .then((data) => {
                    if (data.success && data.redirect) {
                        window.location.href = data.redirect;
                    }
                })
                .catch((error) => {
                    console.error('Login error:', error);
                    if (error.message) {
                        showNotification(error.message, 'error');
                    } else {
                        showNotification('Login failed. Please try again.', 'error');
                    }
                })
                .finally(() => {
                    loginBtn.disabled = false;
                    btnText.textContent = 'Log In';
                    loadingSpinner.classList.add('hidden');
                });

            });
        </script>
        <script src="{{ asset('js/functions.js') }}"></script>
    </body>
</html>
