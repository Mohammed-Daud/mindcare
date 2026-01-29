<!DOCTYPE html>
<html class="light" lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <title>Doctor Onboarding: Professional Details</title>
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&amp;family=Noto+Sans:wght@400..700&amp;display=swap" rel="stylesheet"/>
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
                            "primary-dark": "#0eaebd",
                            "background-light": "#f6f8f8",
                            "background-dark": "#102022",
                            "surface-light": "#ffffff",
                            "surface-dark": "#1a2c2e",
                            "text-main": "#0d1a1b",
                            "text-sub": "#4c939a",
                            "border-color": "#cfe5e7",
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
    <body class="bg-background-light dark:bg-background-dark text-text-main dark:text-gray-100 font-display transition-colors duration-200">
        <div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
            <!-- Top Navigation -->
            <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#e7f2f3] dark:border-b-slate-700 px-6 lg:px-10 py-3 bg-surface-light dark:bg-surface-dark sticky top-0 z-50">
                <div class="flex items-center gap-4 text-text-main dark:text-white">
                    <div class="size-8 flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined text-3xl">psychology</span>
                    </div>
                    <h2 class="text-text-main dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">
                        {{ config('app.name') }}
                    </h2>
                </div>
                <div class="flex flex-1 justify-end gap-8 items-center">
                    <div class="hidden md:flex items-center gap-9">
                        <span class="text-text-sub dark:text-gray-400 text-sm font-medium leading-normal cursor-not-allowed opacity-50">Dashboard</span>
                        <span class="text-text-sub dark:text-gray-400 text-sm font-medium leading-normal cursor-not-allowed opacity-50">Patients</span>
                        <span class="text-text-sub dark:text-gray-400 text-sm font-medium leading-normal cursor-not-allowed opacity-50">Schedule</span>
                    </div>
                    <div class="flex items-center gap-3 pl-4 border-l border-[#e7f2f3] dark:border-slate-700">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-text-main dark:text-white">Dr. Sarah Wilson</p>
                            <p class="text-xs text-text-sub dark:text-gray-400">Psychiatrist</p>
                        </div>
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 ring-2 ring-primary/20" data-alt="Profile picture of a doctor" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAmp9TTdlPIPm93RXKLfVupRCqeiOf4Mt4Em4zJt3P_TPNUHwb7X9ks1B5r6Y2MN2QuIrYAZ0zQjybeKNhjAf_BbH6QJT0-fiNKOCTdsXEoH3WbXaq0cziGkbh7TXnVdsWzYqELoG8Mvst6T89voKjaJhv85dGGuXmuO_RYrOU5CqZ9rafRxvWb7AyYRqHiulrmFpl0CchsO9urjziV4eLSH4Cun0-8FGC-dnPfpKz8Z5vnKpA4zwsvTwqO2kh-hFF03g7HA4WUc7v5");'></div>
                    </div>
                </div>
            </header>
            <div class="layout-container flex h-full grow flex-col w-full max-w-7xl mx-auto px-4 md:px-8 lg:px-20 py-8">
                <!-- Progress Bar -->
                <div class="flex flex-col gap-3 mb-8 max-w-[960px] mx-auto w-full">
                    <div class="flex gap-6 justify-between items-end">
                        <p class="text-text-main dark:text-white text-base font-medium leading-normal">Step 2 of 4: Professional Details</p>
                        <span class="text-text-sub dark:text-gray-400 text-xs font-semibold uppercase tracking-wider hidden sm:block">50% Completed</span>
                    </div>
                    <div class="rounded-full bg-[#cfe5e7] dark:bg-slate-700 overflow-hidden">
                        <div class="h-2 rounded-full bg-primary transition-all duration-500 ease-out" style="width: 50%;"></div>
                    </div>
                </div>
                <!-- Main Content Area -->
                <div class="flex flex-col lg:flex-row gap-8 max-w-[960px] mx-auto w-full">
                    <!-- Left Column: Form -->
                    <div class="flex-1 flex flex-col gap-6">
                        <!-- Header -->
                        <div class="flex flex-col gap-2">
                            <h1 class="text-text-main dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">Tell us about your practice</h1>
                            <p class="text-text-sub dark:text-gray-400 text-base font-normal leading-normal">
                                Your professional details help match you with the right patients. This information will be displayed on your public profile.
                            </p>
                        </div>
                        <!-- Form Card -->
                        <div class="bg-surface-light dark:bg-surface-dark rounded-xl p-6 md:p-8 shadow-sm border border-[#e7f2f3] dark:border-slate-700 flex flex-col gap-6">
                            <!-- Specializations -->
                            <div class="flex flex-col gap-3">
                                <label class="flex flex-col w-full">
                                    <p class="text-text-main dark:text-gray-200 text-base font-medium leading-normal pb-2">Primary Specializations</p>
                                    <div class="relative">
                                        <select class="form-input flex w-full resize-none overflow-hidden rounded-lg text-text-main dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-color dark:border-slate-600 bg-background-light dark:bg-slate-800 h-14 placeholder:text-text-sub p-[15px] text-base font-normal leading-normal appearance-none pr-10 cursor-pointer">
                                            <option disabled="" selected="" value="">Select specializations (e.g. Anxiety, PTSD)</option>
                                            <option value="anxiety">Anxiety Disorders</option>
                                            <option value="depression">Clinical Depression</option>
                                            <option value="ptsd">PTSD</option>
                                            <option value="bipolar">Bipolar Disorder</option>
                                        </select>
                                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-text-sub">
                                            <span class="material-symbols-outlined">expand_more</span>
                                        </div>
                                    </div>
                                </label>
                                <!-- Selected Chips -->
                                <div class="flex gap-3 flex-wrap pt-1">
                                    <div class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-[#e7f2f3] dark:bg-slate-700 pl-4 pr-3 transition-colors hover:bg-primary/20">
                                        <p class="text-text-main dark:text-gray-200 text-sm font-medium leading-normal">Clinical Depression</p>
                                        <button class="size-4 flex items-center justify-center rounded-full hover:bg-black/10 dark:hover:bg-white/10 text-text-sub dark:text-gray-400">
                                        <span class="material-symbols-outlined text-[16px]">close</span>
                                        </button>
                                    </div>
                                    <div class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-[#e7f2f3] dark:bg-slate-700 pl-4 pr-3 transition-colors hover:bg-primary/20">
                                        <p class="text-text-main dark:text-gray-200 text-sm font-medium leading-normal">Anxiety Disorders</p>
                                        <button class="size-4 flex items-center justify-center rounded-full hover:bg-black/10 dark:hover:bg-white/10 text-text-sub dark:text-gray-400">
                                        <span class="material-symbols-outlined text-[16px]">close</span>
                                        </button>
                                    </div>
                                    <div class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-[#e7f2f3] dark:bg-slate-700 pl-4 pr-3 transition-colors hover:bg-primary/20">
                                        <p class="text-text-main dark:text-gray-200 text-sm font-medium leading-normal">PTSD</p>
                                        <button class="size-4 flex items-center justify-center rounded-full hover:bg-black/10 dark:hover:bg-white/10 text-text-sub dark:text-gray-400">
                                        <span class="material-symbols-outlined text-[16px]">close</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- License & Experience Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <label class="flex flex-col w-full">
                                    <div class="flex items-center gap-2 pb-2">
                                        <p class="text-text-main dark:text-gray-200 text-base font-medium leading-normal">Medical License ID</p>
                                        <span class="material-symbols-outlined text-text-sub text-[18px]" title="Your license number is encrypted">lock</span>
                                    </div>
                                    <input class="form-input flex w-full rounded-lg text-text-main dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-color dark:border-slate-600 bg-background-light dark:bg-slate-800 h-14 placeholder:text-text-sub/70 p-[15px] text-base font-normal leading-normal" placeholder="e.g. MD-12345-NY" type="text"/>
                                </label>
                                <label class="flex flex-col w-full">
                                    <p class="text-text-main dark:text-gray-200 text-base font-medium leading-normal pb-2">Years of Experience</p>
                                    <input class="form-input flex w-full rounded-lg text-text-main dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-color dark:border-slate-600 bg-background-light dark:bg-slate-800 h-14 placeholder:text-text-sub/70 p-[15px] text-base font-normal leading-normal" placeholder="e.g. 8" type="number"/>
                                </label>
                            </div>
                            <!-- Education -->
                            <div class="flex flex-col gap-4">
                                <div class="flex justify-between items-center">
                                    <p class="text-text-main dark:text-gray-200 text-base font-medium leading-normal">Education</p>
                                </div>
                                <div class="flex flex-col gap-3">
                                    <div class="grid grid-cols-1 sm:grid-cols-[1fr_1fr_auto] gap-3 items-start">
                                        <input class="form-input w-full rounded-lg text-text-main dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-color dark:border-slate-600 bg-background-light dark:bg-slate-800 h-12 placeholder:text-text-sub/70 px-4 text-base" placeholder="Degree (e.g. MD Psychiatry)" type="text"/>
                                        <input class="form-input w-full rounded-lg text-text-main dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-color dark:border-slate-600 bg-background-light dark:bg-slate-800 h-12 placeholder:text-text-sub/70 px-4 text-base" placeholder="University / Institution" type="text"/>
                                        <button class="h-12 w-12 flex items-center justify-center rounded-lg border border-border-color dark:border-slate-600 text-text-sub hover:bg-background-light dark:hover:bg-slate-700 hover:text-red-500 transition-colors">
                                        <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </div>
                                    <button class="flex items-center gap-2 text-primary hover:text-primary-dark font-medium text-sm self-start mt-1">
                                    <span class="material-symbols-outlined text-[20px]">add_circle</span>
                                    Add another qualification
                                    </button>
                                </div>
                            </div>
                            <!-- Bio -->
                            <label class="flex flex-col w-full">
                                <div class="flex justify-between items-baseline pb-2">
                                    <p class="text-text-main dark:text-gray-200 text-base font-medium leading-normal">Professional Biography</p>
                                    <span class="text-xs text-text-sub">Min 150 characters</span>
                                </div>
                                <textarea class="form-input flex w-full rounded-lg text-text-main dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-color dark:border-slate-600 bg-background-light dark:bg-slate-800 min-h-[140px] placeholder:text-text-sub/70 p-[15px] text-base font-normal leading-normal resize-y" placeholder="Share your approach to mental health care, your philosophy, and what patients can expect during a session..."></textarea>
                                <p class="text-xs text-text-sub mt-2 text-right">0/1000</p>
                            </label>
                        </div>
                        <!-- Actions -->
                        <div class="flex items-center justify-between pt-4">
                            <button class="flex items-center justify-center h-12 px-6 rounded-lg border border-[#cfe5e7] dark:border-slate-600 bg-transparent text-text-sub dark:text-gray-300 font-bold hover:bg-[#e7f2f3] dark:hover:bg-slate-800 transition-all">
                            Back
                            </button>
                            <div class="flex items-center gap-4">
                                <span class="text-sm text-text-sub dark:text-gray-500 hidden sm:block italic">Draft saved automatically</span>
                                <button class="flex items-center justify-center h-12 px-8 rounded-lg bg-primary hover:bg-primary-dark text-white dark:text-slate-900 font-bold shadow-md hover:shadow-lg transition-all transform active:scale-95">
                                Save &amp; Continue
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Right Column: Helper Panel -->
                    <div class="w-full lg:w-80 flex flex-col gap-6">
                        <!-- Helper Card 1 -->
                        <div class="bg-gradient-to-br from-[#e7f2f3] to-white dark:from-slate-800 dark:to-slate-900 p-6 rounded-xl border border-[#cfe5e7] dark:border-slate-700 sticky top-24">
                            <div class="size-10 rounded-full bg-white dark:bg-slate-700 flex items-center justify-center shadow-sm mb-4">
                                <span class="material-symbols-outlined text-primary text-2xl">lightbulb</span>
                            </div>
                            <h3 class="text-text-main dark:text-white text-lg font-bold mb-2">Tips for a Great Bio</h3>
                            <ul class="flex flex-col gap-3 text-sm text-text-main dark:text-gray-300 leading-relaxed">
                                <li class="flex items-start gap-2">
                                    <span class="material-symbols-outlined text-primary text-[18px] mt-0.5">check_circle</span>
                                    <span>Focus on your patient care philosophy and approach.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="material-symbols-outlined text-primary text-[18px] mt-0.5">check_circle</span>
                                    <span>Mention specific conditions you have extensive experience treating.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="material-symbols-outlined text-primary text-[18px] mt-0.5">check_circle</span>
                                    <span>Keep the tone warm, empathetic, and professional.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Background Decoration (Optional for subtle texture) -->
        <div class="fixed inset-0 pointer-events-none z-[-1] opacity-50" style="background-image: radial-gradient(#cfe5e7 1px, transparent 1px); background-size: 32px 32px;"></div>
    </body>
</html>
