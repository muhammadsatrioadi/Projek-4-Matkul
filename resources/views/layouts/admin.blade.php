@extends('layouts.shared')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Admin Sidebar -->
        <div class="col-md-3 col-lg-2 admin-sidebar">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.hospitals.index') }}">
                            <i class="fas fa-hospital"></i> Hospitals
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">
                            <i class="fas fa-users"></i> Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.registrations') }}">
                            <i class="fas fa-clipboard-list"></i> Registrations
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Admin Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            @yield('admin-content')
        </main>
    </div>
</div>
@endsection 