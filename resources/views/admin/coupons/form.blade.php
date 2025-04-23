@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($coupon) ? 'Edit Coupon Code' : 'Create Coupon Code' }}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($coupon) ? route('admin.coupons.update', $coupon) : route('admin.coupons.store') }}" method="POST">
                        @csrf
                        @if(isset($coupon))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="code">Coupon Code</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code', $coupon->code ?? '') }}" required>
                            @error('code')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                                <option value="percentage" {{ (old('type', $coupon->type ?? '') == 'percentage') ? 'selected' : '' }}>Percentage</option>
                                <option value="fixed" {{ (old('type', $coupon->type ?? '') == 'fixed') ? 'selected' : '' }}>Fixed Amount</option>
                            </select>
                            @error('type')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="value">Value</label>
                            <input type="number" class="form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ old('value', $coupon->value ?? '') }}" required min="0" step="0.01">
                            @error('value')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description', $coupon->description ?? '') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="starts_at">Start Date</label>
                            <input type="date" class="form-control @error('starts_at') is-invalid @enderror" id="starts_at" name="starts_at" value="{{ old('starts_at', isset($coupon) ? $coupon->starts_at->format('Y-m-d') : '') }}" required>
                            @error('starts_at')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="expires_at">Expiry Date</label>
                            <input type="date" class="form-control @error('expires_at') is-invalid @enderror" id="expires_at" name="expires_at" value="{{ old('expires_at', isset($coupon) ? $coupon->expires_at->format('Y-m-d') : '') }}" required>
                            @error('expires_at')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $coupon->is_active ?? true) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">Active</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection 