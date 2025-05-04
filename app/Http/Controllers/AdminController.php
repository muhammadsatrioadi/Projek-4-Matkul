<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\McuRegistration;

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
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            Auth::logout();
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
            if ($user->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }
            
            Auth::logout();
            return back()->withErrors([
                'email' => 'You do not have admin privileges.',
            ])->withInput();
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function dashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalRegistrations = McuRegistration::count();
        $pendingRegistrations = McuRegistration::where('status', 'pending')->count();
        $completedRegistrations = McuRegistration::where('status', 'completed')->count();
        $recentRegistrations = McuRegistration::with(['user', 'hospital'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalRegistrations',
            'pendingRegistrations',
            'completedRegistrations',
            'recentRegistrations'
        ));
    }

    public function registrations(Request $request)
    {
        $query = McuRegistration::with(['user', 'hospital', 'payment']);

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('hospital_id')) {
            $query->where('hospital_id', $request->hospital_id);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('appointment_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('appointment_date', '<=', $request->date_to);
        }

        $registrations = $query->latest()->paginate(10);
        $hospitals = \App\Models\Hospital::all();

        return view('admin.registrations', compact('registrations', 'hospitals'));
    }

    public function showRegistration($id)
    {
        $registration = McuRegistration::with(['user', 'hospital', 'payment'])
            ->findOrFail($id);

        return view('admin.registration-detail', compact('registration'));
    }

    public function updateRegistrationStatus(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'in:pending,approved,completed,cancelled']
        ]);

        $registration = McuRegistration::findOrFail($id);
        $registration->status = $request->status;
        $registration->save();

        return response()->json([
            'success' => true,
            'message' => 'Registration status updated successfully.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'You have been logged out successfully.');
    }
}
