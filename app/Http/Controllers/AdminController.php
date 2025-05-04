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
        $this->middleware('admin')->except(['showLogin', 'login']);
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
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_registrations' => McuRegistration::count(),
            'pending_registrations' => McuRegistration::where('status', 'pending')->count(),
            'completed_registrations' => McuRegistration::where('status', 'completed')->count(),
        ];

        $recent_registrations = McuRegistration::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_registrations'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'You have been logged out successfully.');
    }
}
