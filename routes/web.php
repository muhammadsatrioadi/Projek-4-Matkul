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

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home/Landing Page Routes
Route::get('/', function () {
    // Clear any existing authentication
    if (auth()->check()) {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
    }
    return view('noUser');
})->name('main');

// Default Authentication Routes
Route::get('/login', function () {
    if (auth()->check()) {
        return redirect()->route('user.dashboard');
    }
    return redirect()->route('user.login');
})->name('login');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/department', [DepartController::class, 'index'])->name('department');
Route::get('/department-single', function () {
    return view('department-single');
})->name('department-single');

Route::get('/doctor', function () {
    return view('doctor');
})->name('doctor');

Route::get('/doctor-single', function () {
    return view('doctor-single');
})->name('doctor-single');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Authentication Routes
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');
    
    // Protected Admin Routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/registrations', [AdminController::class, 'registrations'])->name('registrations');
        Route::get('/registrations/{id}', [AdminController::class, 'showRegistration'])->name('registrations.show');
        Route::patch('/registrations/{id}/status', [AdminController::class, 'updateRegistrationStatus'])->name('registrations.update.status');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});

// User Authentication Routes
Route::prefix('user')->name('user.')->group(function () {
    // User Authentication Routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    
    // Password Reset Routes
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
    
    // Protected User Routes
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
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
    Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('process.payment');
    Route::get('/payment-success', function () {
        return view('payment-success');
    })->name('payment.success');
    
    // Appointment Routes
    Route::get('/appointment', function () {
        return view('appointment');
    })->name('appointment');
});

// Public Hospital Routes
Route::get('/hospitals', [HospitalController::class, 'index'])->name('hospitals.index');
Route::get('/hospitals/{hospital}', [HospitalController::class, 'show'])->name('hospitals.show');
