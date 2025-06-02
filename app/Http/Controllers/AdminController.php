<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\McuRegistration;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['showLogin', 'login']);
    }

    public function index()
    {
        $users = User::where('role', 'user')->get();
        $pendingRegistrations = McuRegistration::where('status', 'pending')->count();
        $totalRegistrations = McuRegistration::count();
        
        return view('admin.index', compact('users', 'pendingRegistrations', 'totalRegistrations'));
    }

    public function updateStatus(Request $request, $id)
    {
        $registration = McuRegistration::findOrFail($id);
        $registration->status = $request->status;
        $registration->save();

        return redirect()->route('admin.index')->with('success', 'Status updated successfully.');
    }

    public function showLogin()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role !== 'admin') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'You do not have admin privileges.',
                ]);
            }

            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function dashboard()
    {
        // Get recent hospitals (limit to 5)
        $recentHospitals = \App\Models\Hospital::latest()->take(5)->get();
        
        // Get recent non-admin users (limit to 5)
        $recentUsers = \App\Models\User::where('role', '!=', 'admin')
            ->latest()
            ->take(5)
            ->get();
        
        // Get total registrations
        $totalRegistrations = \App\Models\McuRegistration::count();
        
        // Get completed MCUs
        $completedMcus = \App\Models\McuRegistration::where('status', 'completed')->count();
        
        // Get pending MCUs
        $pendingMcus = \App\Models\McuRegistration::whereIn('status', ['pending', 'confirmed'])->count();
        
        // Get total users (excluding admins)
        $totalUsers = \App\Models\User::where('role', '!=', 'admin')->count();
        
        // Get recent registrations
        $recentRegistrations = \App\Models\McuRegistration::with(['user', 'hospital'])
            ->latest()
            ->take(10)
            ->get();
        
        // Get package distribution data
        $packageDistribution = [
            \App\Models\McuRegistration::where('mcu_package', 'basic')->count(),
            \App\Models\McuRegistration::where('mcu_package', 'standard')->count(),
            \App\Models\McuRegistration::where('mcu_package', 'premium')->count(),
        ];
        
        // Get status distribution data
        $statusDistribution = [
            \App\Models\McuRegistration::where('status', 'pending')->count(),
            \App\Models\McuRegistration::where('status', 'confirmed')->count(),
            \App\Models\McuRegistration::where('status', 'completed')->count(),
            \App\Models\McuRegistration::where('status', 'cancelled')->count(),
        ];
        
        return view('admin.dashboard', compact(
            'recentHospitals',
            'recentUsers',
            'totalRegistrations',
            'completedMcus',
            'pendingMcus',
            'totalUsers',
            'recentRegistrations',
            'packageDistribution',
            'statusDistribution'
        ));
    }

    public function registrations()
    {
        $registrations = McuRegistration::with(['user', 'hospital'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.registrations.index', compact('registrations'));
    }

    public function showRegistration($id)
    {
        $registration = McuRegistration::with(['user', 'hospital', 'payment'])
            ->findOrFail($id);

        return view('admin.registrations.show', compact('registration'));
    }

    public function updateRegistrationStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $registration = McuRegistration::findOrFail($id);
        $registration->status = $request->status;
        $registration->save();

        return back()->with('success', 'Registration status updated successfully.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
