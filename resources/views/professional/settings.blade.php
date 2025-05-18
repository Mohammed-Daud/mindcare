@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center pt-5">
        <div class="col-md-8 py-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Professional Settings</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('professional.settings.update') }}" method="POST" class="settings-form">
                        @csrf
                        @method('PUT')

                        <!-- Session Durations and Fees -->
                        <div class="mb-4">
                            <h5>Session Settings</h5>
                            <div class="session-settings">
                                <div id="session-durations-container">
                                    @if($settings && isset($settings->session_durations) && isset($settings->session_fees))
                                        @foreach($settings->session_durations as $index => $duration)
                                            <div class="row mb-3 session-duration-row">
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" name="session_durations[]" 
                                                               value="{{ old("session_durations.$index", $duration) }}" 
                                                               min="30" step="30" required>
                                                        <span class="input-group-text">minutes</span>
                                                        <input type="number" class="form-control" name="session_fees[]" 
                                                               value="{{ old("session_fees.$index", $settings->session_fees[$index] ?? '') }}" 
                                                               placeholder="Fee" min="0" step="0.01" required>
                                                        <span class="input-group-text">₹</span>
                                                        @if($index > 0)
                                                            <button type="button" class="btn btn-outline-danger remove-duration">-</button>
                                                        @else
                                                            <button type="button" class="btn btn-outline-secondary add-duration">+</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="row mb-3 session-duration-row">
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="session_durations[]" 
                                                           value="{{ old('session_durations.0', 30) }}" 
                                                           min="30" step="30" required>
                                                    <span class="input-group-text">minutes</span>
                                                    <input type="number" class="form-control" name="session_fees[]" 
                                                           value="{{ old('session_fees.0', '') }}" 
                                                           placeholder="Fee" min="0" step="0.01" required>
                                                    <span class="input-group-text">₹</span>
                                                    <button type="button" class="btn btn-outline-secondary add-duration">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                @error('session_durations')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @error('session_fees')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Working Days -->
                        <div class="mb-4">
                            <h5>Working Days</h5>
                            <div class="row">
                                @php
                                    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                    $workingDays = old('working_days', $settings->working_days ?? []);
                                @endphp
                                @foreach($days as $day)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="working_days[]" 
                                                   value="{{ $day }}" id="day_{{ $day }}"
                                                   {{ in_array($day, $workingDays) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="day_{{ $day }}">
                                                {{ $day }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('working_days')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Working Hours -->
                        <div class="mb-4">
                            <h5>Working Hours</h5>
                            <div class="working-hours">
                                @foreach($days as $day)
                                    <div class="row mb-3 day-hours" id="hours_{{ $day }}" style="display: none;">
                                        <div class="col-12">
                                            <label class="form-label">{{ $day }} Hours</label>
                                            <div class="input-group">
                                                <input type="time" class="form-control" 
                                                       name="working_hours[{{ $day }}][start]" 
                                                       value="{{ old("working_hours.$day.start", $settings->working_hours[$day]['start'] ?? '09:00') }}"
                                                       required>
                                                <span class="input-group-text">to</span>
                                                <input type="time" class="form-control" 
                                                       name="working_hours[{{ $day }}][end]" 
                                                       value="{{ old("working_hours.$day.end", $settings->working_hours[$day]['end'] ?? '17:00') }}"
                                                       required>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('working_hours')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Buffer Time -->
                        <div class="mb-4">
                            <h5>Buffer Time</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="buffer_time" 
                                               value="{{ old('buffer_time', $settings->buffer_time ?? 15) }}" 
                                               min="0" max="60" required>
                                        <span class="input-group-text">minutes</span>
                                    </div>
                                    <small class="form-text text-muted">Time between appointments</small>
                                    @error('buffer_time')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Availability Toggle -->
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_available" 
                                       id="is_available" value="1" 
                                       {{ old('is_available', $settings->is_available ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_available">
                                    Accepting New Appointments
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="session_fees">Session Fees (₹)</label>
                            <div id="session_fees_container">
                                @if($settings && isset($settings->session_fees))
                                    @foreach($settings->session_fees as $duration => $fee)
                                        <div class="input-group mb-2">
                                            <input type="number" class="form-control" name="session_fees[{{ $duration }}]" value="{{ $fee }}" placeholder="Fee for {{ $duration }} minutes">
                                            <div class="input-group-append">
                                                <span class="input-group-text">₹</span>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="allow_client_reschedule" name="allow_client_reschedule" value="1" {{ old('allow_client_reschedule', $settings->allow_client_reschedule ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="allow_client_reschedule">Allow Clients to Reschedule Appointments</label>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="max_reschedule_count" class="form-label">Maximum Number of Reschedules Allowed</label>
                            <input type="number" class="form-control" id="max_reschedule_count" name="max_reschedule_count" value="{{ old('max_reschedule_count', $settings->max_reschedule_count ?? 0) }}" min="0">
                            <small class="form-text text-muted">Set to 0 to disable rescheduling completely</small>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                            <a href="{{ route('professional.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Debug: Log initial state
    console.log('Settings loaded:', @json($settings));
    
    // Handle working days checkboxes
    const dayCheckboxes = document.querySelectorAll('input[name="working_days[]"]');
    console.log('Found checkboxes:', dayCheckboxes.length);
    
    dayCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const dayHours = document.getElementById('hours_' + this.value);
            console.log('Toggling hours for:', this.value, dayHours);
            if (dayHours) {
                dayHours.style.display = this.checked ? 'block' : 'none';
            }
        });
        
        // Trigger change event on load to show/hide working hours
        checkbox.dispatchEvent(new Event('change'));
    });

    // Handle session durations
    const sessionDurationsContainer = document.getElementById('session-durations-container');
    
    // Add new duration
    sessionDurationsContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('add-duration')) {
            const newRow = document.createElement('div');
            newRow.className = 'row mb-3 session-duration-row';
            newRow.innerHTML = `
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="number" class="form-control" name="session_durations[]" 
                               value="30" min="30" step="30" required>
                        <span class="input-group-text">minutes</span>
                        <input type="number" class="form-control" name="session_fees[]" 
                               placeholder="Fee" min="0" step="0.01" required>
                        <span class="input-group-text">₹</span>
                        <button type="button" class="btn btn-outline-danger remove-duration">-</button>
                    </div>
                </div>
            `;
            sessionDurationsContainer.appendChild(newRow);
        }
        
        // Remove duration
        if (e.target.classList.contains('remove-duration')) {
            e.target.closest('.session-duration-row').remove();
        }
    });
});
</script>
@endpush
@endsection 