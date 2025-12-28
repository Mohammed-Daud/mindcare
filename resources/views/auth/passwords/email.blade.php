


<!DOCTYPE html>
<html class="light" lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <title>Forgot Password - PsychConsult</title>
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect"/>
        <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;family=Noto+Sans:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
        <!-- Material Symbols -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
        <!-- Theme Config -->
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
            <!-- Top Navigation -->
            <header class="sticky top-0 z-50 w-full bg-white/80 dark:bg-surface-dark/80 backdrop-blur-md border-b border-gray-100 dark:border-gray-800">
                <div class="flex items-center justify-between px-6 lg:px-20 py-4 max-w-7xl mx-auto w-full">
                    <div class="flex items-center gap-3">
                        <div class="text-primary dark:text-primary">
                            <span class="material-symbols-outlined text-3xl">psychology</span>
                        </div>
                        <h2 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">PsychConsult</h2>
                    </div>
                    <div class="hidden md:flex items-center gap-3">
                        <a class="px-5 py-2 text-sm font-bold text-gray-700 dark:text-gray-200 hover:text-primary transition-colors" href="{{ route('login') }}">
                        Log in
                        </a>
                        <a class="px-5 py-2 text-sm font-bold bg-primary text-gray-900 rounded-lg hover:bg-primary/90 transition-colors shadow-sm" href="{{ route('client.register') }}">
                        Sign up
                        </a>
                    </div>
                    <!-- Mobile Menu Button -->
                    <button class="md:hidden p-2 text-gray-600 dark:text-gray-300">
                    <span class="material-symbols-outlined">menu</span>
                    </button>
                </div>
            </header>
            <!-- Main Content Area -->
            <main class="flex-grow flex items-center justify-center p-4 sm:p-6 lg:p-8">
                <div class="w-full max-w-[480px] bg-white dark:bg-surface-dark rounded-xl shadow-lg border border-gray-100 dark:border-gray-800 overflow-hidden relative">
                    <!-- Decorative Top Gradient Line -->
                    <div class="h-1.5 w-full bg-gradient-to-r from-primary/60 via-primary to-primary/60"></div>
                    <div class="p-8 sm:p-10 flex flex-col gap-6">
                        <!-- Header Section -->
                        <div class="flex flex-col gap-3 text-center">
                            <div class="w-14 h-14 mx-auto bg-primary/10 rounded-full flex items-center justify-center mb-2">
                                <span class="material-symbols-outlined text-primary text-3xl">lock_reset</span>
                            </div>
                            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Forgot Password?</h1>
                            <p class="text-secondary dark:text-gray-400 text-base leading-relaxed">
                                Don't worry, it happens. Please enter the email address associated with your account so we can help you reset it securely.
                            </p>
                        </div>
                        <!-- Form Section -->
                        <form action="#" class="flex flex-col gap-5 mt-2" onsubmit="event.preventDefault();">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-900 dark:text-gray-200 ml-1" for="email">
                                Email Address
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <span class="material-symbols-outlined text-gray-400 group-focus-within:text-primary transition-colors">mail</span>
                                    </div>
                                    <input class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all duration-200" id="email" placeholder="name@example.com" required="" type="email"/>
                                </div>
                            </div>
                            <button class="w-full flex items-center justify-center gap-2 bg-primary hover:bg-primary/90 text-gray-900 font-bold py-3.5 px-4 rounded-lg shadow-md shadow-primary/20 transition-all duration-200 transform hover:-translate-y-0.5" type="submit">
                            <span>Send Reset Instructions</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </button>
                        </form>
                        <!-- Divider -->
                        <div class="relative flex py-2 items-center">
                            <div class="flex-grow border-t border-gray-100 dark:border-gray-700"></div>
                            <span class="flex-shrink-0 mx-4 text-gray-400 text-xs uppercase tracking-wider font-semibold">Or</span>
                            <div class="flex-grow border-t border-gray-100 dark:border-gray-700"></div>
                        </div>
                        <!-- Footer Link -->
                        <div class="text-center">
                            <a class="inline-flex items-center gap-1.5 text-secondary hover:text-primary dark:text-gray-400 dark:hover:text-primary text-sm font-semibold transition-colors duration-200 group" href="{{ route('login') }}">
                            <span class="material-symbols-outlined text-lg group-hover:-translate-x-1 transition-transform">arrow_back</span>
                            Remember your password? Log in
                            </a>
                        </div>
                    </div>
                    <!-- Secure Footer Badge -->
                    <div class="bg-gray-50 dark:bg-gray-800/50 py-3 px-8 border-t border-gray-100 dark:border-gray-800 flex items-center justify-center gap-2 text-xs text-gray-400 dark:text-gray-500">
                        <span class="material-symbols-outlined text-sm">lock</span>
                        <span>Secure Encrypted Connection</span>
                    </div>
                </div>
            </main>
            <!-- Footer Visual Element (Optional context image/texture) -->
            <div class="hidden lg:block fixed bottom-0 left-0 p-10 opacity-30 pointer-events-none z-[-1]">
                <!-- Abstract decorative element to maintain clean look without heavy imagery -->
                <div class="w-64 h-64 bg-primary/20 rounded-full blur-[100px]"></div>
            </div>
            <div class="hidden lg:block fixed top-20 right-0 p-10 opacity-30 pointer-events-none z-[-1]">
                <!-- Abstract decorative element -->
                <div class="w-96 h-96 bg-blue-400/10 rounded-full blur-[120px]"></div>
            </div>
        </div>
    </body>
</html>

<!-- <form method="POST" action="{{ url('/password/email') }}">
    @csrf
    <input type="hidden" name="user_type" value="{{ request()->query('usertype', 'user') }}">

    <div class="form-group">
        <label for="email">Email Address</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <span class="error-message" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <button type="submit" class="btn-primary">
        Send Password Reset Link
    </button>
</form>

<div class="auth-links">
    @php
        $userType = request()->query('usertype', 'user');
        $loginRoute = match($userType) {
            'professional' => 'professional.login',
            'client' => 'login',
            'admin' => 'admin.login',
            default => 'login'
        };
    @endphp
    <a href="{{ route($loginRoute) }}">
        Back to Login
    </a>
    <br>

</div>
</div>
</div> -->
