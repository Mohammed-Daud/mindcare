<!DOCTYPE html>
<html class="light" lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <title>Doctor Onboarding - MindfulCare</title>
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
                            "background-light": "#f6f8f8",
                            "background-dark": "#102022",
                            "text-dark": "#0d1a1b",
                            "text-light": "#ffffff",
                            "slate-custom": "#4c939a",
                        },
                        fontFamily: {
                            "display": ["Manrope", "Noto Sans", "sans-serif"],
                            "body": ["Noto Sans", "sans-serif"],
                        },
                        borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "2xl": "1rem", "full": "9999px"},
                    },
                },
            }
        </script>
        <style>
            .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            }
            .material-symbols-outlined.filled {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            }
            .step-connector {
            position: absolute;
            left: 19px;
            top: 40px;
            width: 2px;
            height: calc(100% - 24px);
            background-color: #e2e8f0;
            }
            .dark .step-connector {
            background-color: #334155;
            }
        </style>
    </head>
    <body class="bg-background-light dark:bg-background-dark font-display text-text-dark dark:text-text-light min-h-screen flex flex-col overflow-x-hidden transition-colors duration-200">
        <header class="sticky top-0 z-50 w-full border-b border-[#e7f2f3] dark:border-slate-800 bg-[#f8fbfc]/80 dark:bg-[#102022]/80 backdrop-blur-md px-6 py-3 lg:px-10">
            <div class="mx-auto flex max-w-[1400px] items-center justify-between">
                <div class="flex items-center gap-4 text-text-dark dark:text-white">
                    <div class="size-8 text-primary">
                        <svg class="w-full h-full" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_6_330)">
                                <path clip-rule="evenodd" d="M24 0.757355L47.2426 24L24 47.2426L0.757355 24L24 0.757355ZM21 35.7574V12.2426L9.24264 24L21 35.7574Z" fill="currentColor" fill-rule="evenodd"></path>
                            </g>
                            <defs>
                                <clipPath id="clip0_6_330">
                                    <rect fill="white" height="48" width="48"></rect>
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold leading-tight tracking-tight">MindfulCare</h2>
                </div>
                <div class="hidden md:flex flex-1 justify-end gap-8 items-center">
                    <nav class="flex items-center gap-8">
                        <a class="text-sm font-semibold hover:text-primary transition-colors dark:text-gray-300" href="#">Dashboard</a>
                        <a class="text-sm font-semibold hover:text-primary transition-colors dark:text-gray-300" href="#">Support</a>
                    </nav>
                    <div class="flex items-center gap-4 border-l border-gray-200 dark:border-gray-700 pl-6">
                        <button class="group flex items-center gap-2">
                            <div class="bg-center bg-no-repeat bg-cover rounded-full size-10 ring-2 ring-offset-2 ring-primary/20 dark:ring-offset-background-dark" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBjIzKUDyPD7g3zNpgzElG5bECohc9p8hbsPIurVql8L0spKKCijK4fleu0ZMpQ1epMryNNKXoXMg0DP5BJYmog_JGAZ0ee2JlSQ63-GR5AdMk_SC80PnFUd3k1IFeRDwAi6-x4NdCJmt4YB_Fh6BJk7pUROcUGQ-x3IcQ7k6QRmwQCN4BnUblpkIONNue48pIxnd7M9KlTgCllFhMRLS74efdxT4eFboMHOvfAu9qU5w33AZvoOsg6UJzhF5ysQBeiY81C18aBBfuY");'></div>
                            <span class="material-symbols-outlined text-gray-400 group-hover:text-primary">expand_more</span>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <div class="flex-1 w-full max-w-[1400px] mx-auto flex flex-col md:flex-row">
            <aside class="w-full md:w-72 lg:w-80 border-r border-[#e7f2f3] dark:border-slate-800 bg-white dark:bg-[#102022] p-8 hidden md:block">
                <div class="sticky top-24">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-8">Onboarding Progress</h3>
                    <div class="flex flex-col gap-0">
                        <div class="relative flex gap-4 pb-10">
                            <div class="step-connector"></div>
                            <div class="relative z-10 flex items-center justify-center size-10 rounded-full bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400">
                                <span class="material-symbols-outlined text-xl filled">check_circle</span>
                            </div>
                            <div class="pt-1">
                                <p class="text-sm font-bold text-slate-400 dark:text-slate-500 line-through">Account Creation</p>
                                <p class="text-xs text-slate-400">Completed</p>
                            </div>
                        </div>
                        <div class="relative flex gap-4 pb-10">
                            <div class="step-connector"></div>
                            <div class="relative z-10 flex items-center justify-center size-10 rounded-full bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400">
                                <span class="material-symbols-outlined text-xl filled">check_circle</span>
                            </div>
                            <div class="pt-1">
                                <p class="text-sm font-bold text-slate-400 dark:text-slate-500 line-through">Professional Details</p>
                                <p class="text-xs text-slate-400">Completed</p>
                            </div>
                        </div>
                        <div class="relative flex gap-4 pb-10">
                            <div class="step-connector"></div>
                            <div class="relative z-10 flex items-center justify-center size-10 rounded-full bg-primary text-text-dark ring-4 ring-primary/20">
                                <span class="text-sm font-bold">03</span>
                            </div>
                            <div class="pt-1">
                                <p class="text-sm font-bold text-text-dark dark:text-white">Verification Upload</p>
                                <p class="text-xs text-primary font-medium">In Progress</p>
                            </div>
                        </div>
                        <div class="relative flex gap-4 pb-10">
                            <div class="step-connector"></div>
                            <div class="relative z-10 flex items-center justify-center size-10 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-400">
                                <span class="text-sm font-bold">04</span>
                            </div>
                            <div class="pt-1">
                                <p class="text-sm font-bold text-slate-500 dark:text-slate-400">Consent &amp; Declaration</p>
                                <p class="text-xs text-slate-400">Pending</p>
                            </div>
                        </div>
                        <div class="relative flex gap-4">
                            <div class="relative z-10 flex items-center justify-center size-10 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-400">
                                <span class="text-sm font-bold">05</span>
                            </div>
                            <div class="pt-1">
                                <p class="text-sm font-bold text-slate-500 dark:text-slate-400">Connect Google</p>
                                <p class="text-xs text-slate-400">Pending</p>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
            <main class="flex-1 overflow-y-auto">
                <div class="max-w-[800px] mx-auto py-10 px-6 lg:px-12 flex flex-col gap-8">
                    <div class="md:hidden flex flex-col gap-3">
                        <div class="flex justify-between items-end">
                            <div>
                                <p class="text-lg font-bold text-text-dark dark:text-white">Verification Upload</p>
                                <p class="text-sm text-slate-custom dark:text-teal-400/70">Step 3 of 5</p>
                            </div>
                            <span class="text-sm font-bold text-primary">60%</span>
                        </div>
                        <div class="rounded-full bg-[#cfe5e7] dark:bg-slate-700 h-2 overflow-hidden">
                            <div class="h-full rounded-full bg-primary transition-all duration-500 ease-out" style="width: 60%;"></div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-text-dark dark:text-white">Verify your Credentials</h1>
                        <p class="text-slate-custom dark:text-gray-400 text-base leading-relaxed">
                            Securely upload your professional documents to ensure patient safety and compliance. All documents are encrypted with bank-level security and are only viewable by our compliance team.
                        </p>
                    </div>
                    <div class="flex flex-col gap-6 bg-white dark:bg-[#1a2c2e] p-6 md:p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800">
                        <div class="flex items-center gap-2 pb-2 border-b border-gray-100 dark:border-slate-700/50">
                            <span class="material-symbols-outlined text-primary">verified_user</span>
                            <h3 class="text-lg font-bold">Required Documents</h3>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold text-text-dark dark:text-gray-200">State Medical License <span class="text-red-500">*</span></label>
                            <div class="group relative flex items-center justify-between p-4 rounded-xl border border-primary/30 bg-primary/5 dark:bg-primary/10 transition-all">
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center justify-center size-10 rounded-lg bg-white dark:bg-slate-800 shadow-sm text-primary">
                                        <span class="material-symbols-outlined filled">description</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-text-dark dark:text-white">License_Dr_Smith_CA.pdf</p>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            <span class="text-xs text-slate-500 dark:text-slate-400">2.4 MB</span>
                                            <span class="flex items-center gap-1 text-xs font-bold text-green-600 dark:text-green-400 bg-green-100 dark:bg-green-900/30 px-1.5 py-0.5 rounded">
                                            <span class="material-symbols-outlined text-[14px]">check_circle</span> Uploaded
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-400 hover:text-text-dark transition-colors" title="View">
                                    <span class="material-symbols-outlined">visibility</span>
                                    </button>
                                    <button class="p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 text-gray-400 hover:text-red-500 transition-colors" title="Remove">
                                    <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold text-text-dark dark:text-gray-200">Board Certification <span class="text-gray-400 font-normal">(Optional)</span></label>
                            <div class="group relative flex flex-col items-center justify-center p-8 rounded-xl border-2 border-dashed border-slate-200 dark:border-slate-700 hover:border-primary hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-all cursor-pointer">
                                <input class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" type="file"/>
                                <div class="mb-3 p-3 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-400 group-hover:text-primary group-hover:bg-primary/10 transition-colors">
                                    <span class="material-symbols-outlined text-3xl">cloud_upload</span>
                                </div>
                                <p class="text-sm font-bold text-text-dark dark:text-white group-hover:text-primary transition-colors">Click to upload or drag and drop</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">PDF, JPG, or PNG (Max 10MB)</p>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-bold text-text-dark dark:text-gray-200">Government-Issued Photo ID <span class="text-red-500">*</span></label>
                            <div class="group relative flex flex-col items-center justify-center p-8 rounded-xl border-2 border-dashed border-slate-200 dark:border-slate-700 hover:border-primary hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-all cursor-pointer">
                                <input class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" type="file"/>
                                <div class="mb-3 p-3 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-400 group-hover:text-primary group-hover:bg-primary/10 transition-colors">
                                    <span class="material-symbols-outlined text-3xl">badge</span>
                                </div>
                                <p class="text-sm font-bold text-text-dark dark:text-white group-hover:text-primary transition-colors">Click to upload or drag and drop</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Clear scan of front and back (Max 5MB)</p>
                            </div>
                        </div>
                        <div class="mt-2 flex items-start gap-3 p-4 bg-primary/5 dark:bg-slate-800/50 rounded-lg border border-primary/10">
                            <span class="material-symbols-outlined text-primary shrink-0">lock</span>
                            <p class="text-xs text-slate-custom dark:text-gray-400 leading-relaxed">
                                Your information is securely stored and HIPAA compliant. We do not share your personal documentation with any third parties without your explicit consent.
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col-reverse md:flex-row items-center justify-between gap-4 pt-6 mt-2 border-t border-slate-200 dark:border-slate-800">
                        <a href="{{ route('doctor.onboarding.step2') }}" class="w-full md:w-auto px-6 py-3 rounded-lg text-sm font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                            Back
                        </a>
                        <div class="flex gap-4 w-full md:w-auto">
                            <button class="w-full md:w-auto px-6 py-3 rounded-lg text-sm font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                            Save for Later
                            </button>
                            <button class="w-full md:w-auto flex items-center justify-center gap-2 px-8 py-3 bg-primary hover:bg-primary/90 text-text-dark rounded-lg text-sm font-bold shadow-lg shadow-primary/20 transition-all transform hover:-translate-y-0.5">
                            <span>Submit &amp; Continue</span>
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
