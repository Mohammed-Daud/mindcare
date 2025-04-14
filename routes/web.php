<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->middleware('auth')->name('profile');
Route::get('/professionals', [App\Http\Controllers\ProfileController::class, 'professionals'])->name('professionals');

// Professional Onboarding Routes (used for registration)
Route::get('/professional/onboarding', [ProfessionalController::class, 'create'])->name('professionals.create');
Route::post('/professional/onboarding', [ProfessionalController::class, 'store'])->name('professionals.store');
Route::get('/professional/onboarding/success', [ProfessionalController::class, 'onboardingSuccess'])->name('professionals.onboarding.success');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/professionals', [ProfessionalController::class, 'index'])->name('professionals.index');
    Route::get('/professionals/{professional}', [ProfessionalController::class, 'show'])->name('professionals.show');
    Route::post('/professionals/{professional}/approve', [ProfessionalController::class, 'approve'])->name('professionals.approve');
    Route::post('/professionals/{professional}/reject', [ProfessionalController::class, 'reject'])->name('professionals.reject');
});
