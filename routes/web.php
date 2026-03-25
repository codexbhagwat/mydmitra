<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleAuthController; // ✅ Fix
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\ServiceController as AdminService;
use App\Http\Controllers\Admin\ApplicationController as AdminApplication;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\User\ApplicationController as UserApplication;
use App\Http\Controllers\ServiceController;

// ── Frontend
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/services', [FrontendController::class, 'services'])->name('services');

// ── Guest Auth
Route::middleware('guest')->group(function () {
    Route::get('/login',     [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login',    [LoginController::class, 'login']);
    Route::get('/register',  [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ── Google OAuth ✅ GoogleAuthController use ho raha hai
Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

// ── User Panel
Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard',       [UserDashboard::class, 'index'])->name('dashboard');
    Route::get('/applications',    [UserDashboard::class, 'applications'])->name('applications');
    Route::get('/apply/{service}', [UserApplication::class, 'apply'])->name('apply');
    Route::post('/apply',          [UserApplication::class, 'store'])->name('apply.store');
});

// ── Payment
Route::middleware('auth')->group(function () {
    Route::get('/payment/{application}',          [PaymentController::class, 'show'])->name('payment');
    Route::post('/payment/{application}/process', [PaymentController::class, 'process'])->name('payment.process');
});

// ── Admin Panel
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    Route::resource('users',    AdminUser::class);
    Route::resource('services', AdminService::class);

    Route::get('/applications',                        [AdminApplication::class, 'index'])->name('applications.index');
    Route::patch('/applications/{application}/status', [AdminApplication::class, 'updateStatus'])->name('applications.status');

    Route::post('services/{service}/toggle', [AdminServiceController::class, 'toggle'])
        ->name('services.toggle');
});

// ── Service Routes
Route::middleware('auth')->group(function () {
    Route::get('/services/{service}',        [ServiceController::class, 'show'])->name('services.show');
    Route::post('/services/{service}/submit',[ServiceController::class, 'submit'])->name('services.submit');
    Route::get('/my-applications',           [ServiceController::class, 'myApplications'])->name('services.my-applications');
    Route::get('/my-applications/{app}',     [ServiceController::class, 'applicationDetail'])->name('services.application');
});