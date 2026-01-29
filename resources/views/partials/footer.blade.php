<footer class="bg-white dark:bg-background-dark border-t border-slate-200 dark:border-slate-800 pt-16 pb-8">
    <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 mb-16">
            <div class="col-span-2 lg:col-span-2">
                <div class="flex items-center gap-2 mb-4">
                    <div class="flex items-center justify-center size-6 rounded bg-primary/10 text-primary">
                        <span class="material-symbols-outlined text-sm">spa</span>
                    </div>
                    <span class="text-lg font-bold text-slate-900 dark:text-white">
                        {{ config('app.name') }}
                    </span>
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
                <h3 class="font-bold text-slate-900 dark:text-white mb-4">
                    Join Us As
                </h3>
                <ul class="space-y-3 text-sm text-slate-600 dark:text-slate-400">
                    <li>
                        <a class="hover:text-primary" href="{{ route('doctor.onboarding.step1') }}">
                            Psychiatry Consultant
                        </a>
                    </li>
                    <li>
                        <a class="hover:text-primary" href="#">
                            Psychiatry Trainee
                        </a>
                    </li>
                    <li>
                        <a class="hover:text-primary" href="#">
                            Psychiatry Internship
                        </a>
                    </li>
                </ul>
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
                    @if(auth()->check())
                    <li>
                        <a class="hover:text-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="border-t border-slate-100 dark:border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-xs text-slate-500 text-center md:text-left">
                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved. <br class="hidden md:inline"/>
                If you are in a life-threatening situation, do not use this site. Call 911 or go to your nearest emergency room.
            </p>
            <div class="flex items-center gap-2 px-3 py-1 rounded bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700">
                <span class="flex size-2 rounded-full bg-green-500"></span>
                <span class="text-xs font-medium text-slate-600 dark:text-slate-300">System Operational</span>
            </div>
        </div>
    </div>
</footer>
<!-- <footer>
    <div class="container">
        <div class="footer-content">
            <div class="footer-column">
                <h3>MindCare</h3>
                <p>Professional online counseling with licensed psychologists and psychiatrists.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Services</h3>
                <ul>
                    <li><a href="#">Individual Therapy</a></li>
                    <li><a href="#">Couples Counseling</a></li>
                    <li><a href="#">Psychiatric Evaluation</a></li>
                    <li><a href="#">Teen Counseling</a></li>
                    <li><a href="#">Trauma Therapy</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Company</h3>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('professionals') }}">Our Team</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Contact</h3>
                <ul>
                    <li><i class="fas fa-phone"></i> (555) 123-4567</li>
                    <li><i class="fas fa-envelope"></i> help@mindcare.com</li>
                    <li><i class="fas fa-map-marker-alt"></i> 123 Therapy Lane, Suite 100</li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('services') }}">Services</a></li>
                    <li><a href="{{ route('professionals') }}">Our Team</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    <li><a href="{{ route('login') }}">Client Login</a></li>
                    <li><a href="{{ route('professional.login') }}">Professional Login</a></li>
                </ul>
            </div>
        </div>
        </div>
        <div class="copyright">
            <p>&copy; {{ date('Y') }} MindCare Professional Counseling. All rights reserved.</p>
        </div>
    </div>
</footer> -->
