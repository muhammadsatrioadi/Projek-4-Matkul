<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\McuRegistrationController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\HospitalController as AdminHospitalController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home/Landing Page Routes
Route::get('/', function () {
    if (auth()->check()) {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
    }
    return view('noUser');
})->name('main');

// Default Authentication Routes
Route::get('/login', function () {
    return auth()->check() ? redirect()->route('user.dashboard') : redirect()->route('user.login');
})->name('login');

Route::get('/about', fn() => view('about'))->name('about');
Route::get('/services', fn() => view('services'))->name('services');
Route::get('/contact', fn() => view('contact'))->name('contact');
Route::get('/privacy', fn() => view('privacy'))->name('privacy');

Route::get('/department', [DepartController::class, 'index'])->name('department');
Route::get('/department-single', fn() => view('department-single'))->name('department-single');
Route::get('/doctor', fn() => view('doctor'))->name('doctor');
Route::get('/doctor-single', fn() => view('doctor-single'))->name('doctor-single');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');
    
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/registrations', [AdminController::class, 'registrations'])->name('registrations');
        Route::get('/registrations/{id}', [AdminController::class, 'showRegistration'])->name('registrations.show');
        Route::patch('/registrations/{id}/status', [AdminController::class, 'updateRegistrationStatus'])->name('registrations.update.status');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
        
        // Hospital Management Routes
        Route::resource('hospitals', AdminHospitalController::class);
        
        // User Management Routes
        Route::resource('users', AdminUserController::class);
    });
});

// User Authentication Routes
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    
    // Password Reset Routes
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
    
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        
        // Profile Routes
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        
        // MCU Registration Routes
        Route::get('/mcu/register', [UserController::class, 'showMcuRegistration'])->name('mcu.register');
        Route::post('/mcu/register', [UserController::class, 'storeMcuRegistration'])->name('mcu.register.submit');
        Route::get('/mcu/history', [UserController::class, 'mcuHistory'])->name('mcu.history');
        Route::get('/mcu/{id}', [UserController::class, 'showMcuDetails'])->name('mcu.show');
    });
});

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Hospital Routes
    Route::get('/selection-hospital', [HospitalController::class, 'selection'])->name('hospitals.selection');
    Route::get('/hospitals/{hospital}', [HospitalController::class, 'show'])->name('hospitals.show');
    Route::get('/hospitals/{hospital}/details', [HospitalController::class, 'getDetails'])->name('hospitals.details');
    
    // MCU Registration Routes
    Route::post('/submit-registration', [RegistrationController::class, 'submitRegistration'])->name('submit-registration');
    Route::get('/verify-registration', [RegistrationController::class, 'verifyRegistration'])->name('verify-registration');
    Route::post('/confirm-registration', [RegistrationController::class, 'confirmRegistration'])->name('confirm-registration');
    Route::post('/create-pdf', [RegistrationController::class, 'createPDF'])->name('create-pdf');
    Route::get('/back-to-main', [RegistrationController::class, 'backToMain'])->name('back-to-main');
    
    // Payment Routes
    Route::post('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment');
    Route::get('/payment/{registration}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{registration}/process', [PaymentController::class, 'processPayment'])->name('process.payment');
    Route::get('/payment/{payment}/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment-success', function() {
        return redirect()->route('user.dashboard')
            ->with('success', 'Your payment has been processed successfully.');
    });
    Route::get('/appointment', fn() => view('appointment'))->name('appointment');
});

// Public Hospital Routes
Route::get('/hospitals', [HospitalController::class, 'index'])->name('hospitals.index');
Route::get('/hospitals/{hospital}', [HospitalController::class, 'show'])->name('hospitals.show');
