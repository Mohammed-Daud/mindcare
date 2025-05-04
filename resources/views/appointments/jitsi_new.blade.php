@extends('layouts.app')

@section('content')
<!-- Hidden input to store meeting link for copy functionality -->
<input type="hidden" id="meeting-link-input" value="{{ url('/appointments/' . $appointment->id . '/jitsi') }}">
<!-- Hidden input for CSRF token -->
<input type="hidden" id="csrf-token" value="{{ csrf_token() }}">

<!-- Hidden form for fallback validation -->
<form id="validate-meeting-form" action="{{ route('validate.meeting.access') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
    <input type="hidden" name="room_name" value="{{ $roomName }}">
</form>

<div class="container-fluid py-3 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-3 pt-2 mt-4">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-video me-2"></i> 
                        @if($isClient)
                            Virtual Session with Dr. {{ $appointment->professional->full_name }}
                        @else
                            Virtual Session with {{ $appointment->client->first_name }} {{ $appointment->client->last_name }}
                        @endif
                    </h5>
                    <div class="d-flex align-items-center">
                        <div id="meeting-timer" class="me-3 bg-light text-primary px-3 py-2 rounded-pill fw-bold">
                            <i class="fas fa-clock me-1"></i> <span id="timer-display">{{ floor($remainingMinutes / 60) }}:{{ str_pad($remainingMinutes % 60, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <span class="badge bg-light text-primary px-3 py-2 rounded-pill">
                            {{ $appointment->start_time->format('d M Y, h:i A') }} - {{ $appointment->end_time->format('h:i A') }}
                        </span>
                    </div>
                </div>
                
                <div class="card-body p-0 position-relative">
                    <!-- Meeting Info Bar -->
                    <div class="bg-light p-2 d-flex justify-content-between align-items-center border-bottom">
                        <div>
                            <span class="badge bg-primary me-2">
                                <i class="fas fa-calendar-alt me-1"></i> {{ $appointment->start_time->format('l, F d, Y') }}
                            </span>
                            <span class="badge bg-info">
                                <i class="fas fa-hourglass-half me-1"></i> {{ $duration }} minutes
                            </span>
                        </div>
                        <div>
                            <span class="badge bg-success">
                                <i class="fas fa-lock me-1"></i> Secure Meeting
                            </span>
                        </div>
                    </div>
                    
                    <!-- Jitsi Container -->
                    <div id="jaas-container" style="height: 75vh;"></div>
                    
                    <!-- Meeting Controls -->
                    <div class="bg-light p-2 d-flex justify-content-between align-items-center border-top">
                        <div class="d-flex align-items-center">
                            <div class="small text-muted me-3">
                                <i class="fas fa-info-circle me-1"></i> Meeting ID: {{ $roomName }}
                            </div>
                            @if($isProfessional)
                            <button id="copy-meeting-link" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Copy meeting link">
                                <i class="fas fa-copy me-1"></i> Copy Link
                            </button>
                            <span id="copy-success" class="ms-2 small text-success" style="display: none;">
                                <i class="fas fa-check-circle me-1"></i> Copied!
                            </span>
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('client.appointments') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back to Appointments
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Meeting Tips -->
            <div class="card mt-3 shadow-sm border-0">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-lightbulb text-warning me-2"></i> Tips for a Successful Meeting
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <div class="d-flex">
                                <div class="flex-shrink-0 text-primary me-2">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <p class="mb-0 small">Find a quiet, well-lit space</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="d-flex">
                                <div class="flex-shrink-0 text-primary me-2">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <p class="mb-0 small">Test your camera and microphone</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="d-flex">
                                <div class="flex-shrink-0 text-primary me-2">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <p class="mb-0 small">Ensure stable internet connection</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Meeting End Warning Modal -->
<div class="modal fade" id="meetingEndModal" tabindex="-1" aria-labelledby="meetingEndModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="meetingEndModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i> Meeting Ending Soon
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <i class="fas fa-clock fa-3x text-warning"></i>
                    </div>
                    <div>
                        <h5>5 Minutes Remaining</h5>
                        <p>Your meeting will end in 5 minutes. Please wrap up your conversation.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Meeting Ended Modal -->
<div class="modal fade" id="meetingEndedModal" tabindex="-1" aria-labelledby="meetingEndedModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="meetingEndedModalLabel">
                    <i class="fas fa-times-circle me-2"></i> Meeting Ended
                </h5>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fas fa-calendar-check fa-4x text-success mb-3"></i>
                    <h4>Session Complete</h4>
                    <p>Your scheduled meeting time has ended. Thank you for using MindCare.</p>
                </div>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> You can book another appointment from your dashboard.
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="{{ route('client.appointments') }}" class="btn btn-primary px-4">
                    <i class="fas fa-calendar-alt me-2"></i> Go to Appointments
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src='https://8x8.vc/vpaas-magic-cookie-e7d1c43a42d34e6a8c80763f4424055a/external_api.js'></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Jitsi API
        const api = new JitsiMeetExternalAPI("8x8.vc", {
            roomName: "vpaas-magic-cookie-e7d1c43a42d34e6a8c80763f4424055a/{{ $roomName }}",
            parentNode: document.querySelector('#jaas-container'),
            userInfo: {
                displayName: '{{ $userName }}',
                email: '{{ $userEmail }}'
            },
            configOverwrite: {
                requireDisplayName: true,
                enableWelcomePage: false,
                prejoinPageEnabled: false,
                startWithAudioMuted: false,
                startWithVideoMuted: false,
                disableDeepLinking: true
            },
            interfaceConfigOverwrite: {
                TOOLBAR_BUTTONS: [
                    'microphone', 
                    'camera', 
                    'chat',
                    'hangup', 
                    'recording',
                    'raisehand',
                    'tileview', 
                    'videobackgroundblur', 
                    'mute-everyone',
                    'fullscreen',
                    'settings'
                ],
                SHOW_JITSI_WATERMARK: false,
                SHOW_WATERMARK_FOR_GUESTS: false,
                DEFAULT_BACKGROUND: '#ffffff',
                DEFAULT_REMOTE_DISPLAY_NAME: 'MindCare User',
                TOOLBAR_ALWAYS_VISIBLE: true
            }
        });

        // Set up timer functionality
        const duration = {{ $duration }};
        const endTime = new Date('{{ $appointment->end_time->toIso8601String() }}');
        const warningTime = 5; // minutes before end to show warning
        let warningShown = false;
        
        // Update timer every second
        const timerInterval = setInterval(updateTimer, 1000);
        
        function updateTimer() {
            const now = new Date();
            const diff = Math.max(0, Math.floor((endTime - now) / 1000)); // difference in seconds
            
            // Calculate minutes and seconds
            const minutes = Math.floor(diff / 60);
            const seconds = diff % 60;
            
            // Update timer display
            const timerDisplay = document.getElementById('timer-display');
            timerDisplay.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
            
            // Change timer color based on remaining time
            const timerElement = document.getElementById('meeting-timer');
            if (minutes <= 5) {
                timerElement.classList.remove('bg-light', 'text-primary');
                timerElement.classList.add('bg-warning', 'text-dark');
            }
            
            // Show warning 5 minutes before end (only once)
            if (minutes === warningTime && seconds === 0 && !warningShown) {
                warningShown = true;
                const warningModal = new bootstrap.Modal(document.getElementById('meetingEndModal'));
                warningModal.show();
                
                // Try to play notification sound if available
                try {
                    const audio = new Audio('/sounds/notification.mp3');
                    audio.play().catch(e => console.log('Audio play failed:', e));
                } catch (error) {
                    console.log('Notification sound not available');
                }
            }
            
            // End meeting when time is up
            if (diff <= 0) {
                clearInterval(timerInterval);
                api.executeCommand('hangup');
                const endedModal = new bootstrap.Modal(document.getElementById('meetingEndedModal'));
                endedModal.show();
            }
        }
        
        // Initial timer update
        updateTimer();
        
        // Handle meeting end
        api.addListener('readyToClose', () => {
            window.location.href = "{{ route('client.appointments') }}";
        });
        
        // Handle video conference joined event
        api.addListener('videoConferenceJoined', () => {
            console.log('User has joined the meeting');
        });
        
        // Handle errors
        api.addListener('error', (error) => {
            console.error('Jitsi Meet error:', error);
        });
        
        // Common variables
        const meetingLinkInput = document.getElementById('meeting-link-input');
        const meetingLink = meetingLinkInput.value;
        
        // Professional-only code for copy functionality
        @if($isProfessional)
        const copyButton = document.getElementById('copy-meeting-link');
        const copySuccess = document.getElementById('copy-success');
        
        // Check authentication status
        fetch('/check-auth')
            .then(response => response.json())
            .then(authData => {
                console.log('Authentication status:', authData);
            })
            .catch(error => {
                console.error('Error checking auth status:', error);
            });
        
        // Add click event listener to copy button
        copyButton.addEventListener('click', function() {
            // Get CSRF token from hidden input
            const csrfToken = document.getElementById('csrf-token').value;
            console.log('Using CSRF token:', csrfToken);
            
            // Check if user is authenticated and associated with the meeting
            fetch('/validate-meeting-access', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                credentials: 'same-origin', // Include cookies in the request
                body: JSON.stringify({
                    appointment_id: {{ $appointment->id }},
                    room_name: '{{ $roomName }}'
                })
            })
            .then(response => {
                console.log('Response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('API response:', data);
                if (data.success) {
                    // User is authenticated and associated with the meeting
                    navigator.clipboard.writeText(meetingLink)
                        .then(() => {
                            // Show success message
                            copySuccess.style.display = 'inline';
                            
                            // Hide success message after 3 seconds
                            setTimeout(() => {
                                copySuccess.style.display = 'none';
                            }, 3000);
                        })
                        .catch(err => {
                            console.error('Failed to copy: ', err);
                            // Fallback for older browsers
                            fallbackCopyTextToClipboard(meetingLink);
                        });
                } else {
                    // User is not authenticated or not associated with the meeting
                    console.error('Authentication failed:', data.message);
                    alert(data.message || 'You are not authorized to copy this meeting link.');
                }
            })
            .catch(error => {
                console.error('Error validating meeting access:', error);
                alert('An error occurred while validating your access to this meeting.');
            });
        });
        
        // Fallback copy method for older browsers
        function fallbackCopyTextToClipboard(text) {
            const textArea = document.createElement('textarea');
            textArea.value = text;
            textArea.style.position = 'fixed';
            textArea.style.left = '-999999px';
            textArea.style.top = '-999999px';
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            
            try {
                const successful = document.execCommand('copy');
                if (successful) {
                    copySuccess.style.display = 'inline';
                    setTimeout(() => {
                        copySuccess.style.display = 'none';
                    }, 3000);
                }
            } catch (err) {
                console.error('Fallback: Oops, unable to copy', err);
            }
            
            document.body.removeChild(textArea);
        }
        @endif
    });
</script>
@endpush