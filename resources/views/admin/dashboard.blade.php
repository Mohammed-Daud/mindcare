@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="admin-cards">
        <div class="admin-card">
            <h3 class="admin-card-title"><i class="fas fa-user-md admin-card-icon"></i> Total Professionals</h3>
            <p class="admin-card-value">{{ $totalProfessionals }}</p>
        </div>
        <div class="admin-card">
            <h3 class="admin-card-title"><i class="fas fa-users admin-card-icon"></i> Total Users</h3>
            <p class="admin-card-value">{{ $totalUsers }}</p>
        </div>
        <div class="admin-card">
            <h3 class="admin-card-title"><i class="fas fa-calendar-check admin-card-icon"></i> Appointments Today</h3>
            <p class="admin-card-value">{{ $appointmentsToday }}</p>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header" style="background-color: var(--primary); color: white;">{{ __('Admin Dashboard') }}</div>
        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Specialization</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentProfessionals as $professional)
                        <tr>
                            <td>{{ $professional->first_name }} {{ $professional->last_name }}</td>
                            <td>{{ $professional->email }}</td>
                            <td>{{ $professional->specialization ?? 'Not specified' }}</td>
                            <td>
                                <span class="badge badge-{{ $professional->status === 'approved' ? 'success' : ($professional->status === 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($professional->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.professionals.show', $professional) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($professional->status === 'pending')
                                    <form action="{{ route('admin.professionals.approve', $professional) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.professionals.reject', $professional) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No professionals found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.professionals.index') }}" class="btn btn-primary btn-sm">View All Professionals</a>
        </div>
    </div>
@endsection

@section('styles')
<style>
    .admin-cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .admin-card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }
    .admin-card-title {
        font-size: 18px;
        margin-top: 0;
        margin-bottom: 15px;
        color: #495057;
    }
    .admin-card-value {
        font-size: 36px;
        font-weight: bold;
        margin: 0;
        color: #343a40;
    }
    .admin-card-icon {
        font-size: 24px;
        margin-right: 10px;
        color: #4a6cf7;
    }
    .admin-table {
        width: 100%;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    .admin-table table {
        width: 100%;
        border-collapse: collapse;
    }
    .admin-table th {
        background-color: #f8f9fa;
        padding: 15px;
        text-align: left;
        font-weight: 600;
        color: #495057;
        border-bottom: 1px solid #dee2e6;
    }
    .admin-table td {
        padding: 15px;
        border-bottom: 1px solid #dee2e6;
    }
    .admin-table tr:last-child td {
        border-bottom: none;
    }
    .admin-table tr:hover {
        background-color: #f8f9fa;
    }
    .admin-action {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
        margin-right: 5px;
    }
    .admin-action-view {
        background-color: #4a6cf7;
        color: #fff;
    }
    .admin-action-edit {
        background-color: #ffc107;
        color: #212529;
    }
    .admin-action-delete {
        background-color: #dc3545;
        color: #fff;
    }
</style>
@endsection 