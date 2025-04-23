@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Coupon Codes</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary float-right">
                        <i class="fas fa-plus"></i> Create New Coupon
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Value</th>
                                <th>Description</th>
                                <th>Valid Period</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ ucfirst($coupon->type) }}</td>
                                    <td>
                                        @if($coupon->type === 'percentage')
                                            {{ $coupon->value }}%
                                        @else
                                            ${{ number_format($coupon->value, 2) }}
                                        @endif
                                    </td>
                                    <td>{{ $coupon->description }}</td>
                                    <td>
                                        {{ $coupon->starts_at->format('M d, Y') }} - 
                                        {{ $coupon->expires_at->format('M d, Y') }}
                                    </td>
                                    <td>
                                        @if($coupon->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this coupon?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No coupon codes found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection 