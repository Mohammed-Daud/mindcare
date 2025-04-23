@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Notifications</h3>
                    @if($notifications->where('read_at', null)->count() > 0)
                        <form action="{{ route('admin.notifications.markAllAsRead') }}" method="POST" class="float-right">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary">Mark All as Read</button>
                        </form>
                    @endif
                </div>
                <div class="card-body">
                    @if($notifications->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($notifications as $notification)
                                        <tr class="{{ $notification->read_at ? '' : 'table-warning' }}">
                                            <td>{{ $notification->data['message'] }}</td>
                                            <td>{{ $notification->created_at->diffForHumans() }}</td>
                                            <td>
                                                @if($notification->read_at)
                                                    <span class="badge badge-success">Read</span>
                                                @else
                                                    <span class="badge badge-warning">Unread</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!$notification->read_at)
                                                    <form action="{{ route('admin.notifications.markAsRead', $notification->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-info">Mark as Read</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $notifications->links() }}
                        </div>
                    @else
                        <div class="text-center">
                            <p class="text-muted">No notifications found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 