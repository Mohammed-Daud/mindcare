<!DOCTYPE html>
<html class="light" lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <title>MindfulCare - Professional Online Psychiatry</title>
        <link href="https://fonts.googleapis.com" rel="preconnect"/>
        <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
        <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&amp;display=swap" rel="stylesheet"/>
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
                            "primary-dark": "#0ea5d9",
                            "background-light": "#f6f8f8",
                            "background-dark": "#101d22",
                            "surface-light": "#ffffff",
                            "surface-dark": "#1a2c32",
                            "text-main": "#0d181b",
                            "text-sub": "#4c869a",
                        },
                        fontFamily: {
                            "display": ["Lexend", "sans-serif"]
                        },
                        borderRadius: {
                            "DEFAULT": "0.5rem",
                            "lg": "0.75rem",
                            "xl": "1rem",
                            "2xl": "1.5rem",
                            "full": "9999px"
                        },
                    },
                },
            }
        </script>
    </head>
    <body class="bg-background-light dark:bg-background-dark text-text-main dark:text-white font-display overflow-x-hidden antialiased">
        <div class="bg-red-50 dark:bg-red-900/20 border-b border-red-100 dark:border-red-800/30">
            <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 py-3">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-red-600 dark:text-red-400">warning</span>
                        <p class="text-sm font-medium text-red-900 dark:text-red-100">
                            <span class="font-bold">Crisis Support:</span> If you are in immediate danger, please call 911 or 988 immediately.
                        </p>
                    </div>
                    <button class="text-xs font-semibold text-red-700 dark:text-red-300 hover:text-red-800 dark:hover:text-red-200 underline whitespace-nowrap">
                    Close Message
                    </button>
                </div>
            </div>
        </div>
        <header class="sticky top-0 z-50 w-full border-b border-slate-200 dark:border-slate-800 bg-surface-light/95 dark:bg-surface-dark/95 backdrop-blur-sm">
            <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="flex items-center justify-center size-8 rounded-lg bg-primary/10 text-primary">
                            <span class="material-symbols-outlined">spa</span>
                        </div>
                        <span class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">MindfulCare</span>
                    </div>
                    <nav class="hidden md:flex items-center gap-8">
                        <a class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-primary transition-colors" href="#">How it Works</a>
                        <a class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-primary transition-colors" href="#">Our Doctors</a>
                        <a class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-primary transition-colors" href="#">FAQ</a>
                    </nav>
                    <div class="flex items-center gap-4">
                        <a class="hidden sm:flex text-sm font-bold text-slate-900 dark:text-white hover:underline" href="#">Log in</a>
                        <a class="hidden lg:inline-flex h-10 items-center justify-center rounded-full border-2 border-primary/20 bg-primary/5 px-6 text-sm font-bold text-primary transition-all hover:bg-primary hover:text-white hover:border-primary hover:shadow-md" href="{{ route('client.register') }}">
                        Patient Sign Up
                        </a>
                        <a class="inline-flex h-10 items-center justify-center rounded-full bg-primary px-6 text-sm font-bold text-white shadow-sm transition-colors hover:bg-primary-dark focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" href="#">
                        Book Appointment
                        </a>
                    </div>
                </div>
            </div>
        </header>
        <main class="flex-1">
            <section class="relative overflow-hidden pt-12 pb-16 lg:pt-24 lg:pb-32">
                <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid lg:grid-cols-2 gap-12 lg:gap-8 items-center">
                        <div class="flex flex-col gap-6 max-w-2xl">
                            <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 dark:border-slate-700 bg-white dark:bg-surface-dark px-3 py-1 w-fit">
                                <span class="flex size-2 rounded-full bg-green-500"></span>
                                <span class="text-xs font-medium text-slate-600 dark:text-slate-300">Accepting new patients</span>
                            </div>
                            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-slate-900 dark:text-white leading-[1.1]">
                                Professional Mental Health Care, From the <span class="text-primary">Comfort of Home</span>
                            </h1>
                            <p class="text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-lg">
                                Private, compassionate, and secure online psychiatric consultations via Google Meet. Connect with board-certified specialists who truly listen.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4 mt-2">
                                <button class="inline-flex h-12 items-center justify-center rounded-lg bg-primary px-8 text-base font-bold text-white shadow-lg shadow-primary/25 transition-all hover:bg-primary-dark hover:-translate-y-0.5">
                                Find a Psychiatrist
                                </button>
                                <button class="inline-flex h-12 items-center justify-center rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-surface-dark px-8 text-base font-bold text-slate-700 dark:text-slate-200 transition-all hover:bg-slate-50 dark:hover:bg-slate-800">
                                How it Works
                                </button>
                            </div>
                            <div class="flex items-center gap-4 mt-4 text-sm text-slate-500 dark:text-slate-400">
                                <div class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                    <span>HIPAA Secure</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                    <span>Insurance Accepted</span>
                                </div>
                            </div>
                        </div>
                        <div class="relative lg:h-auto rounded-2xl overflow-hidden shadow-2xl bg-slate-100 dark:bg-slate-800">
                            <div class="aspect-[4/3] w-full bg-cover bg-center" data-alt="Calm professional woman smiling during a video consultation on a laptop in a bright home office" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCMB7sl_epoqaIx6g7rVrq_YCSD1bFR6w6wz9h6hrIUVlfME9krGcQWTwsUWNoS32NLQ27QvRtYFs8j6Vrou4XVWydJjVX1t_5tcuMmcJ_bybx0sKMG5-pM9Ungunhi3_sgQ-ZwY14bejaY7qcAQCNbTUfgM3ir2SQ4iaJv9gAF8j7R7IMPmzOJDSJtIeYZJ3bOW3URC_ynXgwHtXmDghf2l-a5m1UxrgMY31K9JpTdtHPjfBQN77CMO39fWDiNgbXDut1GWyz7tg-6');"></div>
                            <div class="absolute bottom-6 left-6 right-6 bg-white/90 dark:bg-surface-dark/95 backdrop-blur-md p-4 rounded-xl shadow-lg border border-white/20">
                                <div class="flex items-center gap-4">
                                    <div class="size-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-400">
                                        <span class="material-symbols-outlined">videocam</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-900 dark:text-white">Secure Video Calls</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">Powered by Google Meet</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="py-16 bg-white dark:bg-surface-dark border-y border-slate-100 dark:border-slate-800/50">
                <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">Compassionate Care You Can Trust</h2>
                        <p class="mt-4 text-lg text-slate-600 dark:text-slate-300">We've built a platform that puts your privacy and comfort first.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="group p-6 rounded-xl bg-background-light dark:bg-background-dark border border-slate-100 dark:border-slate-800 hover:border-primary/30 dark:hover:border-primary/30 transition-colors">
                            <div class="size-12 rounded-lg bg-blue-100 dark:bg-blue-900/20 text-primary flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-3xl">medical_services</span>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Licensed Psychiatrists</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">Board-certified MDs specializing in anxiety, depression, and more.</p>
                        </div>
                        <div class="group p-6 rounded-xl bg-background-light dark:bg-background-dark border border-slate-100 dark:border-slate-800 hover:border-primary/30 dark:hover:border-primary/30 transition-colors">
                            <div class="size-12 rounded-lg bg-teal-100 dark:bg-teal-900/20 text-teal-600 dark:text-teal-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-3xl">lock</span>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">100% Confidential</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">HIPAA compliant platform ensuring your sessions remain private.</p>
                        </div>
                        <div class="group p-6 rounded-xl bg-background-light dark:bg-background-dark border border-slate-100 dark:border-slate-800 hover:border-primary/30 dark:hover:border-primary/30 transition-colors">
                            <div class="size-12 rounded-lg bg-indigo-100 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-3xl">laptop_mac</span>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Consult Anywhere</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">Connect via secure video calls from the comfort of your home.</p>
                        </div>
                        <div class="group p-6 rounded-xl bg-background-light dark:bg-background-dark border border-slate-100 dark:border-slate-800 hover:border-primary/30 dark:hover:border-primary/30 transition-colors">
                            <div class="size-12 rounded-lg bg-amber-100 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-3xl">calendar_month</span>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Flexible Scheduling</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">Easy appointment booking integrated with Google Calendar.</p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="py-20 bg-background-light dark:bg-background-dark">
                <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col lg:flex-row gap-16 items-center">
                        <div class="flex-1 space-y-8">
                            <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">Simple steps to start feeling better</h2>
                            <div class="space-y-6">
                                <div class="flex gap-4">
                                    <div class="flex-none flex items-center justify-center size-10 rounded-full bg-white dark:bg-surface-dark border-2 border-primary text-primary font-bold shadow-sm">1</div>
                                    <div>
                                        <h4 class="text-lg font-bold text-slate-900 dark:text-white">Choose your specialist</h4>
                                        <p class="text-slate-600 dark:text-slate-400 mt-1">Browse profiles, read reviews, and find a psychiatrist that fits your needs.</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="flex-none flex items-center justify-center size-10 rounded-full bg-white dark:bg-surface-dark border-2 border-primary text-primary font-bold shadow-sm">2</div>
                                    <div>
                                        <h4 class="text-lg font-bold text-slate-900 dark:text-white">Book instantly</h4>
                                        <p class="text-slate-600 dark:text-slate-400 mt-1">Select a time that works for you. We'll send a Google Calendar invite automatically.</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="flex-none flex items-center justify-center size-10 rounded-full bg-white dark:bg-surface-dark border-2 border-primary text-primary font-bold shadow-sm">3</div>
                                    <div>
                                        <h4 class="text-lg font-bold text-slate-900 dark:text-white">Join the call</h4>
                                        <p class="text-slate-600 dark:text-slate-400 mt-1">At your appointment time, simply click the Google Meet link to start your session.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1 w-full max-w-md lg:max-w-full">
                            <div class="bg-white dark:bg-surface-dark rounded-2xl shadow-xl border border-slate-100 dark:border-slate-800 p-8">
                                <div class="flex items-center justify-between mb-6 pb-6 border-b border-slate-100 dark:border-slate-800">
                                    <div class="flex items-center gap-3">
                                        <div class="size-10 rounded-full bg-blue-600 flex items-center justify-center text-white">
                                            <span class="material-symbols-outlined text-xl">calendar_today</span>
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900 dark:text-white">Consultation</p>
                                            <p class="text-xs text-slate-500">Google Calendar</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-bold text-slate-900 dark:text-white">Today</p>
                                        <p class="text-xs text-slate-500">2:00 PM - 2:45 PM</p>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-4">
                                    <div class="flex -space-x-2 overflow-hidden">
                                        <img alt="" class="inline-block size-8 rounded-full ring-2 ring-white dark:ring-surface-dark object-cover" data-alt="Avatar of doctor" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBqU92Uh7TMwss8JDtFA30MzK3UGsxyVJP1MnCvKdXsShdNBH1X7dsIzFUA6xRzBTxNjvLFk-LeoVNyeezQ3JJ-A2poc0rS4hvd5eaUCnE0bWcbYgH0IGPGYHzoB7ZYmEwfK7UYE97IDmMfYcjuQ5EsrzjmAhYBlPw8R86UlViZJgXsNaIB-EfEO_KZ2G8CQlBVwCaryCJAvHDQ_t-Vhqp0G3TatmP3ZXG-tCq36_KX4pMDYy38ZhdiCgR9PT2UBXq_uxFBi1yEVsc_"/>
                                        <img alt="" class="inline-block size-8 rounded-full ring-2 ring-white dark:ring-surface-dark object-cover" data-alt="Avatar of patient" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCvxrQQN7g1vsRypb1oZs4_PBStVN5pVYNL5ZkR6_kBknRZPxvImMa3MDo0kALIc5KarRjo1OfqSRSYbDjgxPFy6WJkwHuqdc9Oya-64qiNleIz6Zh4I3t6INkVDHuIxdKUzrUaxAwsmLdsUXlBU8kpD73TdLJQM4yW5evKoAZett3c__41ZoVzt1TZr9wCjlOc1l6y2mtx9NU68gL6-GT7LrX6JDp9jKpVeo1Oi0Rywh8Lujbk2y00ql0tFFl4gVOEDRVQx0lf5MYR"/>
                                    </div>
                                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg flex items-center justify-center gap-2 transition-colors">
                                    <span class="material-symbols-outlined">video_camera_front</span>
                                    Join with Google Meet
                                    </button>
                                    <p class="text-center text-xs text-slate-400">Secure, encrypted video connection</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="py-16 bg-white dark:bg-surface-dark border-t border-slate-100 dark:border-slate-800">
                <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">Stories of Healing</h2>
                        <p class="mt-4 text-lg text-slate-600 dark:text-slate-300 max-w-2xl mx-auto">
                            Hear from patients who have found clarity and peace through our platform. All testimonials are anonymized to protect privacy.
                        </p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-background-light dark:bg-background-dark p-8 rounded-2xl relative">
                            <span class="material-symbols-outlined absolute top-6 right-6 text-4xl text-primary/10">format_quote</span>
                            <div class="flex gap-1 mb-4 text-yellow-400">
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                            </div>
                            <p class="text-slate-700 dark:text-slate-300 italic mb-6 leading-relaxed">
                                "I was skeptical about online psychiatry, but Dr. Chen made me feel heard and understood within the first 5 minutes. The video quality was perfect, and I didn't have to leave my living room."
                            </p>
                            <div class="flex items-center gap-3">
                                <div class="size-10 rounded-full bg-teal-100 dark:bg-teal-900/40 flex items-center justify-center text-teal-600 dark:text-teal-400 font-bold text-sm">
                                    JD
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900 dark:text-white text-sm">J.D.</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">Anxiety Patient</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-background-light dark:bg-background-dark p-8 rounded-2xl relative">
                            <span class="material-symbols-outlined absolute top-6 right-6 text-4xl text-primary/10">format_quote</span>
                            <div class="flex gap-1 mb-4 text-yellow-400">
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                            </div>
                            <p class="text-slate-700 dark:text-slate-300 italic mb-6 leading-relaxed">
                                "The flexibility to schedule appointments around my work hours was a game changer. The Google Calendar integration meant I never missed a session. Truly professional service."
                            </p>
                            <div class="flex items-center gap-3">
                                <div class="size-10 rounded-full bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center text-blue-600 dark:text-blue-400 font-bold text-sm">
                                    MK
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900 dark:text-white text-sm">M.K.</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">Depression Patient</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-background-light dark:bg-background-dark p-8 rounded-2xl relative">
                            <span class="material-symbols-outlined absolute top-6 right-6 text-4xl text-primary/10">format_quote</span>
                            <div class="flex gap-1 mb-4 text-yellow-400">
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star_half</span>
                            </div>
                            <p class="text-slate-700 dark:text-slate-300 italic mb-6 leading-relaxed">
                                "Finally found a platform that takes privacy seriously. Knowing everything is HIPAA secure allowed me to open up completely. My doctor was incredibly compassionate."
                            </p>
                            <div class="flex items-center gap-3">
                                <div class="size-10 rounded-full bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-sm">
                                    RL
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900 dark:text-white text-sm">R.L.</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">PTSD Patient</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="py-16 bg-white dark:bg-surface-dark border-t border-slate-100 dark:border-slate-800">
                <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-end mb-10">
                        <div>
                            <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white">Meet Our Specialists</h2>
                            <p class="mt-2 text-slate-600 dark:text-slate-400">Experienced professionals dedicated to your mental well-being.</p>
                        </div>
                        <a class="hidden sm:flex items-center gap-1 text-primary font-bold hover:underline" href="#">
                        View all doctors
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div class="flex flex-col rounded-xl border border-slate-200 dark:border-slate-800 bg-background-light dark:bg-background-dark overflow-hidden transition-all hover:shadow-lg hover:-translate-y-1">
                            <div class="h-48 overflow-hidden">
                                <img alt="" class="w-full h-full object-cover" data-alt="Portrait of Dr. Sarah Chen, a professional psychiatrist smiling warmly" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCd7-rFckPh4G_-3Nbz29Svxfe7XC_qcfRk5FyXlaeoHPY3LhNngNtQqQoBJhnjKndIxTULz9pgg3FzYnjqqkouoSAeXi8AfIP1Ub3uGOUguAqCmkAKEHlXzUQ1zQgLQQApyOgZED5OZoHGpNElDtEa_o8QoLjDq6GW2-UFdnt5rvDt3Ad6Lr6yEYwChU4b5aXG-aib2Zy9SsfLhjOFv0WUsa3GXYuLiHPXsf6rVohLZKukX6d1pe8GEfz6wf43WvQDwr-i2vb0lNyO"/>
                            </div>
                            <div class="p-5 flex flex-col flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="font-bold text-lg text-slate-900 dark:text-white">Dr. Sarah Chen</h3>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">Psychiatrist, MD</p>
                                    </div>
                                    <div class="flex items-center gap-1 bg-white dark:bg-surface-dark px-2 py-1 rounded text-xs font-bold shadow-sm">
                                        <span class="material-symbols-outlined text-yellow-400 text-sm">star</span>
                                        4.9
                                    </div>
                                </div>
                                <div class="flex gap-2 mb-4 flex-wrap">
                                    <span class="px-2 py-1 rounded bg-slate-200 dark:bg-slate-700 text-xs font-medium text-slate-700 dark:text-slate-300">Anxiety</span>
                                    <span class="px-2 py-1 rounded bg-slate-200 dark:bg-slate-700 text-xs font-medium text-slate-700 dark:text-slate-300">Depression</span>
                                </div>
                                <div class="mt-auto pt-4 border-t border-slate-200 dark:border-slate-700 flex items-center justify-between">
                                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Next available: <span class="text-green-600 dark:text-green-400">Today</span></p>
                                    <button class="text-sm font-bold text-primary hover:text-primary-dark">Book Now</button>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col rounded-xl border border-slate-200 dark:border-slate-800 bg-background-light dark:bg-background-dark overflow-hidden transition-all hover:shadow-lg hover:-translate-y-1">
                            <div class="h-48 overflow-hidden">
                                <img alt="" class="w-full h-full object-cover" data-alt="Portrait of Dr. James Wilson, a professional psychiatrist in a suit" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBK-VkuAkWLR9qdS-6FlJHRqkYYDhrEGoCRJXeGb9kfZh7isxbLrpCbMqjJ3vMloeUlN1kiG5igkZMyGiLFYVMDucE-d0fvLXjqSJmIvsGf7jP2G5FqtnaHbXBmEZkfx2JfvWf80le0DhR1N6wm9r5DLtYJKN6A8NsxO_1EN631F1ug8RE7sedl5pksEDwJhnwc2Ssj8uLGBpIW2DxsJM_9fSy97Mrjg-jsw_vzxy8m9oaUgGq6f8JCCK_rmjBFwtdSTdegN_RVSc_K"/>
                            </div>
                            <div class="p-5 flex flex-col flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="font-bold text-lg text-slate-900 dark:text-white">Dr. James Wilson</h3>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">Psychiatrist, MD, PhD</p>
                                    </div>
                                    <div class="flex items-center gap-1 bg-white dark:bg-surface-dark px-2 py-1 rounded text-xs font-bold shadow-sm">
                                        <span class="material-symbols-outlined text-yellow-400 text-sm">star</span>
                                        5.0
                                    </div>
                                </div>
                                <div class="flex gap-2 mb-4 flex-wrap">
                                    <span class="px-2 py-1 rounded bg-slate-200 dark:bg-slate-700 text-xs font-medium text-slate-700 dark:text-slate-300">PTSD</span>
                                    <span class="px-2 py-1 rounded bg-slate-200 dark:bg-slate-700 text-xs font-medium text-slate-700 dark:text-slate-300">Trauma</span>
                                </div>
                                <div class="mt-auto pt-4 border-t border-slate-200 dark:border-slate-700 flex items-center justify-between">
                                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Next available: <span class="text-slate-900 dark:text-white">Tomorrow</span></p>
                                    <button class="text-sm font-bold text-primary hover:text-primary-dark">Book Now</button>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col rounded-xl border border-slate-200 dark:border-slate-800 bg-background-light dark:bg-background-dark overflow-hidden transition-all hover:shadow-lg hover:-translate-y-1">
                            <div class="h-48 overflow-hidden">
                                <img alt="" class="w-full h-full object-cover" data-alt="Portrait of Dr. Emily Rodriguez, a professional psychiatrist" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAgrMrWF467zmIwc3y6gzoscsuUSpEQNRVfxX0_0AUwYQ6bbVIbkKWj1mXfnkT7RxolNyBhcHrmyOwq4Jm84vZKQrqsw16FX9Oq6nEACEF7WNHAFzNP3IckUOxkn7zRGMSsVDUMp_9n94EL2SODOlZdPDFF63_RcxhAEr0BmTraokJivcr7J2gfTn_oTU_J1_tQ9YWU9rig08nH2N7StDDp1w2osEsL1I5YU-LsNR9K5WztTeHEFqgDrBUTvAq2v5RqEeJ56bWNWHHG"/>
                            </div>
                            <div class="p-5 flex flex-col flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="font-bold text-lg text-slate-900 dark:text-white">Dr. Emily Rodriguez</h3>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">Child Psychiatrist, MD</p>
                                    </div>
                                    <div class="flex items-center gap-1 bg-white dark:bg-surface-dark px-2 py-1 rounded text-xs font-bold shadow-sm">
                                        <span class="material-symbols-outlined text-yellow-400 text-sm">star</span>
                                        4.8
                                    </div>
                                </div>
                                <div class="flex gap-2 mb-4 flex-wrap">
                                    <span class="px-2 py-1 rounded bg-slate-200 dark:bg-slate-700 text-xs font-medium text-slate-700 dark:text-slate-300">Adolescent</span>
                                    <span class="px-2 py-1 rounded bg-slate-200 dark:bg-slate-700 text-xs font-medium text-slate-700 dark:text-slate-300">ADHD</span>
                                </div>
                                <div class="mt-auto pt-4 border-t border-slate-200 dark:border-slate-700 flex items-center justify-between">
                                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Next available: <span class="text-green-600 dark:text-green-400">Today</span></p>
                                    <button class="text-sm font-bold text-primary hover:text-primary-dark">Book Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 sm:hidden text-center">
                        <a class="inline-flex items-center gap-1 text-primary font-bold hover:underline" href="#">
                        View all doctors
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </section>
            <section class="py-20 bg-primary/5 dark:bg-slate-900">
                <div class="max-w-4xl mx-auto px-4 text-center">
                    <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-6">Ready to take the first step?</h2>
                    <p class="text-lg text-slate-600 dark:text-slate-300 mb-10 max-w-2xl mx-auto">
                        Join thousands of patients who have found peace of mind with our secure, online psychiatric care.
                    </p>
                    <button class="inline-flex h-12 items-center justify-center rounded-lg bg-primary px-10 text-base font-bold text-white shadow-lg shadow-primary/25 transition-all hover:bg-primary-dark hover:-translate-y-0.5">
                    Find Your Psychiatrist
                    </button>
                </div>
            </section>
        </main>
        <footer class="bg-white dark:bg-background-dark border-t border-slate-200 dark:border-slate-800 pt-16 pb-8">
            <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 mb-12">
                    <div class="col-span-2 lg:col-span-2">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="flex items-center justify-center size-6 rounded bg-primary/10 text-primary">
                                <span class="material-symbols-outlined text-sm">spa</span>
                            </div>
                            <span class="text-lg font-bold text-slate-900 dark:text-white">MindfulCare</span>
                        </div>
                        <p class="text-sm text-slate-500 dark:text-slate-400 max-w-xs mb-6">
                            Compassionate, professional mental health care accessible from anywhere.
                        </p>
                        <div class="flex gap-4">
                            <a class="text-slate-400 hover:text-primary" href="#">
                                <span class="sr-only">Twitter</span>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                </svg>
                            </a>
                            <a class="text-slate-400 hover:text-primary" href="#">
                                <span class="sr-only">LinkedIn</span>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path clip-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" fill-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900 dark:text-white mb-4">Services</h3>
                        <ul class="space-y-3 text-sm text-slate-600 dark:text-slate-400">
                            <li><a class="hover:text-primary" href="#">Psychiatry</a></li>
                            <li><a class="hover:text-primary" href="#">Therapy</a></li>
                            <li><a class="hover:text-primary" href="#">Medication Management</a></li>
                            <li><a class="hover:text-primary" href="#">Anxiety Treatment</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900 dark:text-white mb-4">Company</h3>
                        <ul class="space-y-3 text-sm text-slate-600 dark:text-slate-400">
                            <li><a class="hover:text-primary" href="#">About Us</a></li>
                            <li><a class="hover:text-primary" href="#">Careers</a></li>
                            <li><a class="hover:text-primary" href="#">Press</a></li>
                            <li><a class="hover:text-primary" href="#">Contact</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900 dark:text-white mb-4">Support</h3>
                        <ul class="space-y-3 text-sm text-slate-600 dark:text-slate-400">
                            <li><a class="hover:text-primary" href="#">Help Center</a></li>
                            <li><a class="hover:text-primary" href="#">Crisis Resources</a></li>
                            <li><a class="hover:text-primary" href="#">Privacy Policy</a></li>
                            <li><a class="hover:text-primary" href="#">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-slate-100 dark:border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-xs text-slate-500 text-center md:text-left">
                        © 2024 MindfulCare Inc. All rights reserved. <br class="hidden md:inline"/>
                        If you are in a life-threatening situation, do not use this site. Call 911 or go to your nearest emergency room.
                    </p>
                    <div class="flex items-center gap-2 px-3 py-1 rounded bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700">
                        <span class="flex size-2 rounded-full bg-green-500"></span>
                        <span class="text-xs font-medium text-slate-600 dark:text-slate-300">System Operational</span>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
