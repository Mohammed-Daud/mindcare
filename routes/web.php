<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ProfessionalController as AdminProfessionalController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProfessionalSettingController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\NotificationController as AppNotificationController;
use App\Http\Controllers\CouponCodeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return bcrypt('12345678');
    return view('welcome');
})->name('home');

// Static Pages
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Authentication Routes
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Password Reset Routes (placeholder for now)
Route::get('/password/reset', function() {
    return view('auth.passwords.email');
})->name('password.request');

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::get('/professionals', [App\Http\Controllers\ProfileController::class, 'professionals'])->name('professionals');
Route::get('/professionals/{slug}', [App\Http\Controllers\ProfileController::class, 'show'])->name('professionals.show');

// Professional Onboarding Routes (used for registration)
Route::get('/professional/onboarding', [ProfessionalController::class, 'create'])->name('professionals.create');
Route::post('/professional/onboarding', [ProfessionalController::class, 'store'])->name('professionals.store');
Route::get('/professional/onboarding/success', [ProfessionalController::class, 'onboardingSuccess'])->name('professionals.onboarding.success');

// Professional Authentication Routes
Route::get('/professional/login', [AuthController::class, 'showProfessionalLoginForm'])->name('professional.login');
Route::post('/professional/login', [AuthController::class, 'professionalLogin'])->name('professional.login.submit');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    
    // Add admin profile routes
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [AdminController::class, 'updatePassword'])->name('password.update');

    // Professional Management Routes
    Route::resource('professionals', AdminProfessionalController::class);
    Route::put('professionals/{professional}/status', [AdminProfessionalController::class, 'updateStatus'])->name('professionals.status');
    Route::post('professionals/{professional}/approve', [AdminProfessionalController::class, 'approve'])->name('professionals.approve');
    Route::post('professionals/{professional}/reject', [AdminProfessionalController::class, 'reject'])->name('professionals.reject');

    // Coupon Management Routes
    Route::resource('coupons', CouponCodeController::class);

    // Notification routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
});

// Professional Routes
Route::middleware(['auth:professional'])->prefix('professional')->name('professional.')->group(function () {
    Route::get('/dashboard', [ProfessionalController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfessionalController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [ProfessionalController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [ProfessionalController::class, 'updateProfile'])->name('profile.update');
    Route::get('/settings', [ProfessionalSettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [ProfessionalSettingController::class, 'update'])->name('settings.update');
    Route::get('/appointments', [ProfessionalController::class, 'appointments'])->name('appointments');
    Route::get('/appointments/{appointment}', [ProfessionalController::class, 'showAppointment'])->name('appointments.show');
    Route::post('/appointments/{appointment}/update-status', [ProfessionalController::class, 'updateAppointmentStatus'])->name('appointments.update-status');
    Route::post('/logout', [ProfessionalController::class, 'logout'])->name('logout');
});

// Client Routes
Route::middleware(['guest'])->group(function () {
    Route::get('/client/register', [ClientController::class, 'showRegistrationForm'])->name('client.register');
    Route::post('/client/register', [ClientController::class, 'register'])->name('client.register.submit');
    Route::get('/client/login', [ClientController::class, 'showLoginForm'])->name('client.login');
    Route::post('/client/login', [ClientController::class, 'login'])->name('client.login');
    Route::get('/client/verify/{token}', [ClientController::class, 'verify'])->name('client.verify');
});

Route::middleware(['auth:client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/logout', [ClientController::class, 'logout'])->name('logout');
    
    // Add appointments routes
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments');
    Route::get('/appointments/create/{professional}', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments/{professional}', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::put('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
    Route::put('/appointments/{appointment}/reschedule', [AppointmentController::class, 'reschedule'])->name('appointments.reschedule');
    Route::post('/appointments/{appointment}/reschedule', [AppointmentController::class, 'reschedule'])->name('appointments.reschedule');
});

// Appointment Availability Check
Route::get('/appointments/check-availability/{professional}', [AppointmentController::class, 'checkAvailability'])
    ->name('appointments.check-availability');
Route::post('/appointments/check-availability/{professional}', [AppointmentController::class, 'checkAvailability'])
    ->name('appointments.check-availability');

// Debug route - Remove after fixing the issue
Route::get('/debug-settings/{professional}', function($professional) {
    $settings = \App\Models\Professional::find($professional)->settings;
    dd([
        'settings' => $settings,
        'working_days' => $settings->working_days ?? [],
        'working_hours' => $settings->working_hours ?? [],
        'session_durations' => $settings->session_durations ?? [],
        'session_fees' => $settings->session_fees ?? [],
        'allow_client_reschedule' => $settings->allow_client_reschedule ?? false,
        'max_reschedule_count' => $settings->max_reschedule_count ?? 0,
    ]);
})->name('debug.settings');
