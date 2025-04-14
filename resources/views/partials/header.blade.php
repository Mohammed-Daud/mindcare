<header>
    <div class="container">
        <nav>
            <a href="{{ route('home') }}" class="logo">Mind<span>Care</span></a>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('professionals') }}">Our Team</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">About</a></li>
                
                @guest
                    <li><a href="{{ route('professionals.create') }}" class="btn btn-outline">Join as Professional</a></li>
                    <li><a href="#" class="btn">Book Session</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                @else
                    @if(Auth::guard('professional')->check())
                        <li><a href="{{ route('professional.dashboard') }}" class="btn">Dashboard</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-outline" style="background: none; border: none; color: inherit; cursor: pointer; padding: 0;">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li><a href="#" class="btn">Book Session</a></li>
                        <li><a href="{{ route('profile') }}">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; padding: 0;">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @endif
                @endguest
            </ul>
            <div class="mobile-menu">
                <i class="fas fa-bars"></i>
            </div>
        </nav>
    </div>
</header>