<!DOCTYPE html>
<html class="light" lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Doctor Onboarding: Professional Details</title>
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&amp;family=Noto+Sans:wght@400..700&amp;display=swap" rel="stylesheet"/>
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
        <style type="text/tailwindcss">
            @layer base {
            .step-active {
            @apply text-primary font-bold;
            }
            .step-completed {
            @apply text-text-sub opacity-80;
            }
            .step-pending {
            @apply text-text-sub/50;
            }
            }
        </style>
    </head>
    <body class="bg-background-light dark:bg-background-dark text-text-main dark:text-gray-100 font-display transition-colors duration-200">
        <div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
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
                        <span class="text-text-sub dark:text-gray-400 text-sm font-medium leading-normal cursor-not-allowed opacity-50">Onboarding Mode</span>
                    </div>
                    <div class="flex items-center gap-3 pl-4 border-l border-[#e7f2f3] dark:border-slate-700">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-text-main dark:text-white">
                                {{auth()->user()->name}}
                            </p>
                            <p class="text-xs text-text-sub dark:text-gray-400">Application in progress</p>
                        </div>
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 ring-2 ring-primary/20" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAmp9TTdlPIPm93RXKLfVupRCqeiOf4Mt4Em4zJt3P_TPNUHwb7X9ks1B5r6Y2MN2QuIrYAZ0zQjybeKNhjAf_BbH6QJT0-fiNKOCTdsXEoH3WbXaq0cziGkbh7TXnVdsWzYqELoG8Mvst6T89voKjaJhv85dGGuXmuO_RYrOU5CqZ9rafRxvWb7AyYRqHiulrmFpl0CchsO9urjziV4eLSH4Cun0-8FGC-dnPfpKz8Z5vnKpA4zwsvTwqO2kh-hFF03g7HA4WUc7v5");'></div>
                    </div>
                </div>
            </header>
            <div class="layout-container flex grow w-full max-w-[1440px] mx-auto px-4 md:px-8 lg:px-10 py-8 gap-8">
                <aside class="hidden lg:flex flex-col w-72 shrink-0 gap-8">
                    <div class="bg-surface-light dark:bg-surface-dark rounded-xl p-6 border border-border-color dark:border-slate-700 shadow-sm">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-text-sub mb-6">Onboarding Progress</h3>
                        <nav class="flex flex-col gap-6">
                            <div class="flex items-start gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="size-6 rounded-full bg-primary/20 text-primary flex items-center justify-center">
                                        <span class="material-symbols-outlined text-sm font-bold">check</span>
                                    </div>
                                    <div class="w-px h-8 bg-border-color dark:bg-slate-700 my-1"></div>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm step-completed">Account Creation</span>
                                    <span class="text-[10px] text-primary font-bold uppercase">Completed</span>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="size-6 rounded-full bg-primary text-white dark:text-slate-900 flex items-center justify-center ring-4 ring-primary/10">
                                        <span class="text-xs font-bold">2</span>
                                    </div>
                                    <div class="w-px h-8 bg-border-color dark:bg-slate-700 my-1"></div>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm step-active">Professional Details</span>
                                    <span class="text-[10px] text-primary font-bold uppercase">Active Step</span>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="size-6 rounded-full border-2 border-border-color dark:border-slate-700 flex items-center justify-center">
                                        <span class="text-xs font-bold text-text-sub/50">3</span>
                                    </div>
                                    <div class="w-px h-8 bg-border-color dark:bg-slate-700 my-1"></div>
                                </div>
                                <div class="flex flex-col pt-0.5">
                                    <span class="text-sm step-pending">Verification Upload</span>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="size-6 rounded-full border-2 border-border-color dark:border-slate-700 flex items-center justify-center">
                                        <span class="text-xs font-bold text-text-sub/50">4</span>
                                    </div>
                                    <div class="w-px h-8 bg-border-color dark:bg-slate-700 my-1"></div>
                                </div>
                                <div class="flex flex-col pt-0.5">
                                    <span class="text-sm step-pending">Consent &amp; Declaration</span>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="size-6 rounded-full border-2 border-border-color dark:border-slate-700 flex items-center justify-center">
                                        <span class="text-xs font-bold text-text-sub/50">5</span>
                                    </div>
                                </div>
                                <div class="flex flex-col pt-0.5">
                                    <span class="text-sm step-pending">Connect Google</span>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="bg-primary/5 dark:bg-slate-800/50 p-6 rounded-xl border border-primary/20 flex flex-col gap-3">
                        <span class="material-symbols-outlined text-primary">help</span>
                        <p class="text-sm font-semibold text-text-main dark:text-white">Need assistance?</p>
                        <p class="text-xs text-text-sub leading-relaxed">Our support team is available Mon-Fri to help with your onboarding process.</p>
                        <button class="text-xs font-bold text-primary text-left hover:underline">Contact Support</button>
                    </div>
                </aside>
                <main class="flex-1 max-w-4xl">
                    <div class="lg:hidden flex flex-col gap-2 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-xs font-bold text-primary uppercase">Step 2 of 5</span>
                            <span class="text-xs text-text-sub">Professional Details</span>
                        </div>
                        <div class="h-1.5 w-full bg-border-color rounded-full">
                            <div class="h-1.5 w-2/5 bg-primary rounded-full"></div>
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col gap-8">
                        <!-- Header -->
                        <div class="flex flex-col gap-2">
                            <h1 class="text-text-main dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">Tell us about your practice</h1>
                            <p class="text-text-sub dark:text-gray-400 text-base font-normal leading-normal">
                                Your professional details help match you with the right patients. This information will be displayed on your public profile.
                            </p>
                        </div>
                        <!-- Form Card -->
                        <form id="professionalDetailsForm" method="POST" action="{{ route('doctor.onboarding.professionalDetails') }}" class="bg-surface-light dark:bg-surface-dark rounded-xl p-6 md:p-8 shadow-sm border border-[#e7f2f3] dark:border-slate-700 flex flex-col gap-6">
                            @csrf
                            <!-- Specializations -->
                            <div class="flex flex-col gap-3">
                                <label class="flex flex-col w-full">
                                    <p class="text-text-main dark:text-gray-200 text-base font-medium leading-normal pb-2">Primary Specializations</p>
                                    <div class="relative">
                                        <select id="specialization-select" class="form-input flex w-full resize-none overflow-hidden rounded-lg text-text-main dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-color dark:border-slate-600 bg-background-light dark:bg-slate-800 h-14 placeholder:text-text-sub p-[15px] text-base font-normal leading-normal appearance-none pr-10 cursor-pointer">
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
                                <div id="specialization-chips" class="flex gap-3 flex-wrap pt-1">

                                </div>
                            </div>
                            <!-- License & Experience Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <label class="flex flex-col w-full">
                                    <div class="flex items-center gap-2 pb-2">
                                        <p class="text-text-main dark:text-gray-200 text-base font-medium leading-normal">
                                            Medical License ID
                                        </p>
                                        <span class="material-symbols-outlined text-text-sub text-[18px]" title="Your license number is encrypted">lock</span>
                                    </div>
                                    <input class="form-input flex w-full rounded-lg text-text-main dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-color dark:border-slate-600 bg-background-light dark:bg-slate-800 h-14 placeholder:text-text-sub/70 p-[15px] text-base font-normal leading-normal" placeholder="e.g. MD-12345-NY" name="medical_license_id" type="text"/>
                                </label>
                                <label class="flex flex-col w-full">
                                    <p class="text-text-main dark:text-gray-200 text-base font-medium leading-normal pb-2">Years of Experience</p>
                                    <input class="form-input flex w-full rounded-lg text-text-main dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-color dark:border-slate-600 bg-background-light dark:bg-slate-800 h-14 placeholder:text-text-sub/70 p-[15px] text-base font-normal leading-normal" placeholder="e.g. 8" type="number" name="years_of_experience"/>
                                </label>
                            </div>
                            <!-- Education -->
                            <div class="flex flex-col gap-4">
                                <div class="flex justify-between items-center">
                                    <p class="text-text-main dark:text-gray-200 text-base font-medium leading-normal">Education</p>
                                </div>
                                <div class="flex flex-col gap-3">
                                    <div class="flex flex-col gap-3" id="education-rows">
                                        <div class="grid grid-cols-1 sm:grid-cols-[1fr_1fr_auto] gap-3 items-start education-row">
                                            <input class="form-input w-full rounded-lg h-12 px-4" placeholder="Degree (e.g. MD Psychiatry)" type="text"/>
                                            <input class="form-input w-full rounded-lg h-12 px-4" placeholder="University / Institution" type="text"/>
                                            <button class="delete-education h-12 w-12 flex items-center justify-center rounded-lg border text-text-sub hover:text-red-500">
                                                <span class="material-symbols-outlined">delete</span>
                                            </button>
                                        </div>
                                    </div>

                                    <button id="add-education" class="flex items-center gap-2 text-primary font-medium text-sm mt-1">
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
                                <textarea id="bio" class="form-input flex w-full rounded-lg text-text-main dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-color dark:border-slate-600 bg-background-light dark:bg-slate-800 min-h-[140px] placeholder:text-text-sub/70 p-[15px] text-base font-normal leading-normal resize-y" placeholder="Share your approach to mental health care, your philosophy, and what patients can expect during a session..."></textarea>
                                <p id="bio-count" class="text-xs text-text-sub mt-2 text-right">0/1000</p>
                            </label>
                        </div>
                        <!-- Actions Buttons -->
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 pb-12">
                            <div class="flex items-center gap-4 w-full sm:w-auto">
                                <!-- <button class="flex flex-1 sm:flex-none items-center justify-center h-12 px-6 rounded-lg border border-[#cfe5e7] dark:border-slate-600 bg-transparent text-text-sub dark:text-gray-300 font-bold hover:bg-[#e7f2f3] dark:hover:bg-slate-800 transition-all">
                                    Back
                                </button> -->
                                <button type="button" id="saveForLaterBtn" class="flex flex-1 sm:flex-none items-center justify-center h-12 px-6 rounded-lg border border-[#cfe5e7] dark:border-slate-600 bg-white dark:bg-slate-800 text-text-main dark:text-white font-bold hover:shadow-md transition-all">
                                    Save for later
                                </button>
                            </div>
                            <div class="flex items-center gap-4 w-full sm:w-auto">
                                <button type="submit" id="saveBtn" class="flex w-full sm:w-auto items-center justify-center h-12 px-10 rounded-lg bg-primary hover:bg-primary-dark text-white dark:text-slate-900 font-bold shadow-md hover:shadow-lg transition-all transform active:scale-95">
                                    <span id="btnText">Save &amp; Continue</span>
                                    <div id="loadingSpinner" class="hidden ml-2">
                                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </div>
                        </form>

                </main>
                <div class="hidden xl:flex flex-col w-80 shrink-0 gap-6">
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
        <div class="fixed inset-0 pointer-events-none z-[-1] opacity-50" style="background-image: radial-gradient(#cfe5e7 1px, transparent 1px); background-size: 32px 32px;"></div>
    </body>
    <script>
    document.addEventListener('DOMContentLoaded', () => {

        /* ===== SPECIALIZATIONS ===== */
        const select = document.getElementById('specialization-select');
        const chips = document.getElementById('specialization-chips');
        let selected = [];

        const renderChips = () => {
            chips.innerHTML = selected.map(s => `
                <span class="flex items-center gap-2 bg-border-color px-3 py-1 rounded-lg text-sm">
                    ${s}
                    <button data-value="${s}" class="remove-chip">✕</button>
                </span>
            `).join('');
        };

        select.addEventListener('change', () => {
            if (select.value && !selected.includes(select.value)) {
                selected.push(select.value);
                renderChips();
            }
            select.value = '';
        });

        chips.addEventListener('click', e => {
            if (!e.target.classList.contains('remove-chip')) return;
            selected = selected.filter(s => s !== e.target.dataset.value);
            renderChips();
        });

        /* ===== EDUCATION ===== */
        const educationRows = document.getElementById('education-rows');
        const addEducation = document.getElementById('add-education');

        const syncEducation = () => {
            const rows = educationRows.querySelectorAll('.education-row');
            rows.forEach(r => {
                const del = r.querySelector('.delete-education');
                del.disabled = rows.length === 1;
                del.classList.toggle('opacity-40', rows.length === 1);
            });
        };

        addEducation.addEventListener('click', () => {
            const row = educationRows.firstElementChild.cloneNode(true);
            row.querySelectorAll('input').forEach(i => i.value = '');
            educationRows.appendChild(row);
            syncEducation();
        });

        educationRows.addEventListener('click', e => {
            if (e.target.closest('.delete-education') && educationRows.children.length > 1) {
                e.target.closest('.education-row').remove();
                syncEducation();
            }
        });

        syncEducation();

        /* ===== BIO ===== */
        const bio = document.getElementById('bio');
        const bioCount = document.getElementById('bio-count');

        bio.addEventListener('input', () => {
            const len = bio.value.length;
            bioCount.textContent = `${len}/1000`;
            bioCount.className =
                len < 150 ? 'text-xs text-red-500 text-right'
                : len > 900 ? 'text-xs text-yellow-500 text-right'
                : 'text-xs text-text-sub text-right';
        });

        /* ===== FORM SUBMISSION ===== */
        const form = document.getElementById('professionalDetailsForm');
        const saveBtn = document.getElementById('saveBtn');
        const btnText = document.getElementById('btnText');
        const loadingSpinner = document.getElementById('loadingSpinner');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Check if form is valid
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            // Validate biography length
            if (bio.value.length > 0 && bio.value.length < 150) {
                showNotification('Biography must be at least 150 characters if provided.', 'error');
                return;
            }

            // Validate specializations
            if (selected.length === 0) {
                showNotification('Please select at least one specialization.', 'error');
                return;
            }

            // Collect education data
            const education = [...educationRows.children].map(r => {
                const inputs = r.querySelectorAll('input');
                return {
                    degree: inputs[0].value,
                    university: inputs[1].value
                };
            }).filter(e => e.degree.trim() && e.university.trim());

            if (education.length === 0) {
                showNotification('Please add at least one education qualification.', 'error');
                return;
            }

            // Show loading state
            saveBtn.disabled = true;
            btnText.textContent = 'Saving...';
            loadingSpinner.classList.remove('hidden');
            saveBtn.classList.add('opacity-75', 'cursor-not-allowed');

            // Prepare form data
            const formData = new FormData(form);

            // Add specializations and education arrays
            formData.delete('specializations');
            formData.delete('education');

            selected.forEach(spec => {
                formData.append('specializations[]', spec);
            });

            education.forEach((edu, index) => {
                formData.append(`education[${index}][degree]`, edu.degree);
                formData.append(`education[${index}][university]`, edu.university);
            });

            // Convert to object for JSON
            const data = Object.fromEntries(formData.entries());

            // Convert arrays back
            data.specializations = selected;
            data.education = education;

            // Send AJAX request
            fetch(form.action, {
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
                if (data.success) {
                    // Show success message
                    showNotification(data.message, 'success');

                    // Redirect after delay
                    setTimeout(() => {
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        }
                    }, 2000);
                } else {
                    // Handle server-side validation errors
                    if (data.errors) {
                        const errorMessages = Object.values(data.errors).flat();
                        errorMessages.forEach(message => {
                            showNotification(message, 'error');
                        });
                    } else if (data.message) {
                        showNotification(data.message, 'error');
                    } else {
                        showNotification('Failed to save details. Please try again.', 'error');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Network error. Please check your connection and try again.', 'error');
            })
            .finally(() => {
                // Reset button state
                saveBtn.disabled = false;
                btnText.textContent = 'Save & Continue';
                loadingSpinner.classList.add('hidden');
                saveBtn.classList.remove('opacity-75', 'cursor-not-allowed');
            });
        });

        /* ===== SAVE FOR LATER ===== */
        const saveForLaterBtn = document.getElementById('saveForLaterBtn');

        saveForLaterBtn.addEventListener('click', function() {
            // Show loading state
            const originalText = saveForLaterBtn.textContent;
            saveForLaterBtn.disabled = true;
            saveForLaterBtn.textContent = 'Saving...';
            saveForLaterBtn.classList.add('opacity-75', 'cursor-not-allowed');

            // Collect form data (same as main form but with save_for_later flag)
            const formData = new FormData(form);

            // Add save_for_later flag
            formData.append('save_for_later', '1');

            // Add specializations and education arrays
            selected.forEach(spec => {
                formData.append('specializations[]', spec);
            });

            const education = [...educationRows.children].map(r => {
                const inputs = r.querySelectorAll('input');
                return {
                    degree: inputs[0].value,
                    university: inputs[1].value
                };
            }).filter(e => e.degree.trim() && e.university.trim());

            education.forEach((edu, index) => {
                formData.append(`education[${index}][degree]`, edu.degree);
                formData.append(`education[${index}][university]`, edu.university);
            });

            // Convert to object for JSON
            const data = Object.fromEntries(formData.entries());

            // Convert arrays back
            data.specializations = selected;
            data.education = education;

            // Send AJAX request
            fetch(form.action, {
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
                if (data.success) {
                    showNotification(data.message, 'success');

                    // For save for later, don't redirect immediately
                    // Just show success and keep user on the page
                } else {
                    // Handle server-side validation errors
                    if (data.errors) {
                        const errorMessages = Object.values(data.errors).flat();
                        errorMessages.forEach(message => {
                            showNotification(message, 'error');
                        });
                    } else if (data.message) {
                        showNotification(data.message, 'error');
                    } else {
                        showNotification('Failed to save progress. Please try again.', 'error');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Network error. Please check your connection and try again.', 'error');
            })
            .finally(() => {
                // Reset button state
                saveForLaterBtn.disabled = false;
                saveForLaterBtn.textContent = originalText;
                saveForLaterBtn.classList.remove('opacity-75', 'cursor-not-allowed');
            });
        });

    });
    </script>
    <script src="{{ asset('js/functions.js') }}"></script>
</html>
