<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ProfessionalController as AdminProfessionalController;

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

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // Professional Management Routes
    Route::resource('professionals', AdminProfessionalController::class);
    Route::put('professionals/{professional}/status', [AdminProfessionalController::class, 'updateStatus'])->name('professionals.status');
    Route::post('professionals/{professional}/approve', [AdminProfessionalController::class, 'approve'])->name('professionals.approve');
    Route::post('professionals/{professional}/reject', [AdminProfessionalController::class, 'reject'])->name('professionals.reject');
});

// Professional Routes
Route::middleware(['auth:professional'])->group(function () {
    Route::get('/professional/dashboard', [ProfessionalController::class, 'dashboard'])->name('professional.dashboard');
    Route::get('/professional/profile', [ProfessionalController::class, 'profile'])->name('professional.profile');
    Route::get('/professional/profile/edit', [ProfessionalController::class, 'editProfile'])->name('professional.profile.edit');
    Route::post('/professional/profile/update', [ProfessionalController::class, 'updateProfile'])->name('professional.profile.update');
});
