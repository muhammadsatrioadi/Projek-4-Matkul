@extends('layouts.shared')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">
                        <i class="fas fa-user me-2"></i>
                        Patient Login
                    </h4>
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('user.login.submit') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="email">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input id="email" type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    name="email" value="{{ old('email') }}" 
                                    required autocomplete="email" autofocus
                                    placeholder="Enter your email">
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input id="password" type="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    name="password" required autocomplete="current-password"
                                    placeholder="Enter your password">
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <div class="row">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="remember">Remember Me</label>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    @if (Route::has('user.password.request'))
                                        <a class="text-primary" href="{{ route('user.password.request') }}">
                                            Forgot Password?
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block w-100">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Login as Patient
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <p>Don't have an account? <a href="{{ route('user.register') }}" class="text-primary">Register here</a></p>
                            <p class="mt-2">Are you an administrator? <a href="{{ route('admin.login') }}" class="text-primary">Admin Login</a></p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Features Section -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card text-center p-3">
                        <i class="fas fa-hospital text-primary mb-2" style="font-size: 24px;"></i>
                        <h6>Choose Hospital</h6>
                        <small>Select from our network of trusted hospitals</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center p-3">
                        <i class="fas fa-calendar-check text-primary mb-2" style="font-size: 24px;"></i>
                        <h6>Book Appointments</h6>
                        <small>Easy scheduling for your medical check-up</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center p-3">
                        <i class="fas fa-file-medical text-primary mb-2" style="font-size: 24px;"></i>
                        <h6>Medical Records</h6>
                        <small>Access your medical history anytime</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 