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
    return view('noUser');
})->name('main');

// Default Authentication Routes
Route::get('/login', function () {
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
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');
    
    // Protected Admin Routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/update-status/{id}', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});

// User Authentication Routes
Route::prefix('user')->group(function () {
    Route::get('/login', [UserController::class, 'showLogin'])->name('user.login');
    Route::post('/login', [UserController::class, 'login'])->name('user.login.submit');
    Route::get('/register', [UserController::class, 'showRegister'])->name('user.register');
    Route::post('/register', [UserController::class, 'register'])->name('user.register.submit');
    
    // Protected User Routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
        Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::put('/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
        Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
    });
});

// Global Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::prefix('password')->group(function () {
    Route::get('/reset', [AuthController::class, 'showResetForm'])->name('password.request');
    Route::post('/email', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset/{token}', [AuthController::class, 'showNewPasswordForm'])->name('password.reset');
    Route::post('/reset', [AuthController::class, 'resetPassword'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Hospital Routes
    Route::get('/selection-hospital', [HospitalController::class, 'selection'])->name('selection.hospital');
    Route::get('/hospital/{id}', [HospitalController::class, 'show'])->name('hospital.show');
    
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
