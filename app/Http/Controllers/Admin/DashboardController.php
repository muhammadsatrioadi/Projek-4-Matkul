<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\User;
use App\Models\McuRegistration;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $stats = [
            'total_users' => User::where('role', '!=', 'admin')->count(),
            'total_hospitals' => Hospital::count(),
            'total_registrations' => McuRegistration::count(),
            'pending_registrations' => McuRegistration::where('status', 'pending')->count()
        ];

        $recent_users = User::where('role', '!=', 'admin')
            ->latest()
            ->take(5)
            ->get();

        $recent_registrations = McuRegistration::with(['user', 'hospital'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_users', 'recent_registrations'));
    }
} 