<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Onboarding | MindCare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput.min.js"></script>
    <style>
        .onboarding-section {
            padding: 150px 0 80px;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
        }
        .onboarding-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .onboarding-header {
            background-color: var(--primary);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .onboarding-header h1 {
            color: white;
            margin-bottom: 10px;
        }
        .onboarding-body {
            padding: 40px;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--secondary);
            font-weight: 500;
        }
        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: var(--accent);
            outline: none;
        }
        .custom-file {
            position: relative;
            display: inline-block;
            width: 100%;
        }
        .custom-file-input {
            position: relative;
            z-index: 2;
            width: 100%;
            height: 38px;
            margin: 0;
            opacity: 0;
        }
        .custom-file-label {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1;
            height: 38px;
            padding: 8px 12px;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
        /* Phone input styling */
        .iti {
            width: 100%;
        }
        .phone-input-container {
            display: flex;
        }
        .phone-input-container .iti {
            flex: 1;
        }
        .text-muted {
            color: #6c757d;
            font-size: 14px;
            margin-top: 5px;
        }
        .invalid-feedback {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }
        .btn-block {
            width: 100%;
            padding: 12px;
            font-size: 16px;
        }
        .mt-3 {
            margin-top: 1rem;
        }
        .text-center {
            text-align: center;
        }
        .text-center a {
            color: var(--accent);
            text-decoration: none;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
        
        /* Language section styling */
        .language-item {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
            align-items: center;
        }
        .language-item .form-control {
            flex: 1;
        }
        .language-controls {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }
        .btn-add-language {
            background-color: var(--accent);
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-remove-language {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Header -->
    @include('partials.header')

    <!-- Onboarding Section -->
    <section class="onboarding-section">
        <div class="container">
            <div class="onboarding-container">
                <div class="onboarding-header">
                    <h1>Professional Onboarding..</h1>
                    <p>Join our team of mental health professionals</p>
                </div>
                <div class="onboarding-body">
                    <form action="{{ route('professionals.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <div class="phone-input-container">
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                                        <input type="hidden" name="country_code" id="country_code" value="{{ old('country_code', '+91') }}">
                                    </div>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @error('country_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="specialization">Specialization</label>
                            <input type="text" class="form-control @error('specialization') is-invalid @enderror" id="specialization" name="specialization" value="{{ old('specialization') }}">
                            @error('specialization')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="qualification">Qualification</label>
                            <input type="text" class="form-control @error('qualification') is-invalid @enderror" id="qualification" name="qualification" value="{{ old('qualification') }}">
                            @error('qualification')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="license_number">License Number</label>
                                    <input type="text" class="form-control @error('license_number') is-invalid @enderror" id="license_number" name="license_number" value="{{ old('license_number') }}">
                                    @error('license_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="license_expiry_date">License Expiry Date</label>
                                    <input type="date" class="form-control @error('license_expiry_date') is-invalid @enderror" id="license_expiry_date" name="license_expiry_date" value="{{ old('license_expiry_date') }}">
                                    @error('license_expiry_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bio">Professional Bio</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="4">{{ old('bio') }}</textarea>
                            @error('bio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label>Languages Known</label>
                            <div id="languages-container">
                                @if(old('languages'))
                                    @foreach(old('languages') as $index => $language)
                                        <div class="language-item">
                                            <input type="text" class="form-control" name="languages[]" placeholder="Language" value="{{ $language }}">
                                            <select class="form-control" name="proficiency[]">
                                                @foreach($proficiencyLevels as $value => $label)
                                                    <option value="{{ $value }}" {{ old('proficiency.'.$index) == $value ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn-remove-language" onclick="removeLanguage(this)">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="language-item">
                                        <input type="text" class="form-control" name="languages[]" placeholder="Language">
                                        <select class="form-control" name="proficiency[]">
                                            @foreach($proficiencyLevels as $value => $label)
                                                <option value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn-remove-language" onclick="removeLanguage(this)">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="language-controls">
                                <button type="button" class="btn-add-language" onclick="addLanguage()">
                                    <i class="fas fa-plus"></i> Add Another Language
                                </button>
                            </div>
                            @error('languages.*')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @error('proficiency.*')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="profile_photo">Profile Photo</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('profile_photo') is-invalid @enderror" id="profile_photo" name="profile_photo">
                                        <label class="custom-file-label" for="profile_photo">Choose file</label>
                                    </div>
                                    @error('profile_photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <small class="text-muted">Accepted formats: JPEG, PNG, JPG, GIF. Max size: 2MB</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cv">CV/Resume</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('cv') is-invalid @enderror" id="cv" name="cv">
                                        <label class="custom-file-label" for="cv">Choose file</label>
                                    </div>
                                    @error('cv')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <small class="text-muted">Accepted formats: PDF, DOC, DOCX. Max size: 2MB</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block">Submit Application</button>
                        </div>
                    </form>

                    <div class="mt-3 text-center">
                        <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('partials.footer')

    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        // Display the name of the file selected
        document.querySelectorAll(".custom-file-input").forEach(function(input) {
            input.addEventListener("change", function() {
                var fileName = this.value.split("\\").pop();
                this.nextElementSibling.innerHTML = fileName;
            });
        });
        
        // Initialize the international telephone input
        document.addEventListener('DOMContentLoaded', function() {
            var phoneInput = document.querySelector("#phone");
            var countryCodeInput = document.querySelector("#country_code");
            
            var iti = window.intlTelInput(phoneInput, {
                initialCountry: "in", // Set India as default
                separateDialCode: true,
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js",
                preferredCountries: ["in", "us", "gb", "ca", "au"]
            });
            
            // Set the initial country code value
            countryCodeInput.value = "+" + iti.getSelectedCountryData().dialCode;
            
            // Update the country code when the user changes it
            phoneInput.addEventListener("countrychange", function() {
                countryCodeInput.value = "+" + iti.getSelectedCountryData().dialCode;
            });
            
            // Handle form submission to ensure the country code is included
            document.querySelector("form").addEventListener("submit", function() {
                countryCodeInput.value = "+" + iti.getSelectedCountryData().dialCode;
            });
        });
        
        // Functions for handling languages
        function addLanguage() {
            const container = document.getElementById('languages-container');
            const languageItems = container.querySelectorAll('.language-item');
            
            // Clone the first language item
            const newItem = languageItems[0].cloneNode(true);
            
            // Clear the values
            newItem.querySelector('input[name="languages[]"]').value = '';
            
            // Add the new item to the container
            container.appendChild(newItem);
        }
        
        function removeLanguage(button) {
            const container = document.getElementById('languages-container');
            const languageItems = container.querySelectorAll('.language-item');
            
            // Don't remove if it's the only one
            if (languageItems.length > 1) {
                button.closest('.language-item').remove();
            } else {
                // If it's the last one, just clear the values
                const item = button.closest('.language-item');
                item.querySelector('input[name="languages[]"]').value = '';
                item.querySelector('select[name="proficiency[]"]').selectedIndex = 0;
            }
        }
    </script>
</body>
</html> 