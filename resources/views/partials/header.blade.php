<header>
    <div class="container">
        <nav>
            <a href="{{ route('home') }}" class="logo">Mind<span>Care</span></a>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('professionals') }}">Our Team</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">About</a></li>
                
                @if(!auth()->check() && !auth()->guard('client')->check() && !auth()->guard('professional')->check())
                    <li><a href="{{ route('professionals.create') }}">Join as Professional</a></li>
                    <li><a href="{{ route('client.login') }}">Book Session</a></li>
                    <li><a href="{{ route('client.login') }}">Login</a></li>
                    <li><a href="{{ route('client.register') }}">Register as Client</a></li>
                @endif

                @if(auth()->guard('client')->check())
                    <li><a href="{{ route('client.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('client.appointments') }}">My Appointments</a></li>
                    <li><a href="{{ route('client.profile') }}">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('client.logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" >
                                Logout
                            </button>
                        </form>
                    </li>
                @endif

                @if(auth()->guard('professional')->check())
                    <li><a href="{{ route('professional.dashboard') }}" class="btn">Dashboard</a></li>
                    <li>
                        <form method="POST" action="{{ route('professional.logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" >
                                Logout
                            </button>
                        </form>
                    </li>
                @endif
            </ul>
            <div class="mobile-menu">
                <i class="fas fa-bars"></i>
            </div>
        </nav>
    </div>
</header>