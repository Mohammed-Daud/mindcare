@extends('admin.layouts.app')

@section('title', 'Manage Professionals')

@section('breadcrumb')
    <li class="breadcrumb-item active">Professionals</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Manage Professionals</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
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
                                @forelse($professionals as $professional)
                                    <tr>
                                        <td>{{ $professional->first_name }} {{ $professional->last_name }}</td>
                                        <td>{{ $professional->email }}</td>
                                        <td>{{ $professional->specialization }}</td>
                                        <td>
                                            <span class="badge badge-{{ $professional->status === 'approved' ? 'success' : ($professional->status === 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($professional->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.professionals.edit', $professional) }}" 
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                @if($professional->status == 'pending')
                                                    <form action="{{ route('admin.professionals.approve', $professional) }}" 
                                                          method="POST" 
                                                          style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success" 
                                                                onclick="return confirm('Are you sure you want to approve this professional?')">
                                                            <i class="fas fa-check"></i> Approve
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.professionals.reject', $professional) }}" 
                                                          method="POST" 
                                                          style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                                onclick="return confirm('Are you sure you want to reject this professional?')">
                                                            <i class="fas fa-times"></i> Reject
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('admin.professionals.destroy', $professional) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Are you sure you want to delete this professional?');"
                                                      style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No professionals found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $professionals->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 