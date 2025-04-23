<!-- Notifications Dropdown Menu -->
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="badge badge-warning navbar-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">{{ auth()->user()->unreadNotifications->count() }} Notifications</span>
        <div class="dropdown-divider"></div>
        
        @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
            <a href="{{ route('admin.notifications.read', $notification->id) }}" class="dropdown-item">
                <i class="fas {{ $notification->data['icon'] ?? 'fa-info-circle' }} mr-2"></i> 
                {{ Str::limit($notification->data['message'], 40) }}
                <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
            </a>
            <div class="dropdown-divider"></div>
        @empty
            <span class="dropdown-item text-muted">No new notifications</span>
            <div class="dropdown-divider"></div>
        @endforelse

        <a href="{{ route('admin.notifications.index') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li> 