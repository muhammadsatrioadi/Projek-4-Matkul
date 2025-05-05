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
        // Get statistics
        $totalUsers = User::where('role', 'user')->count();
        $totalRegistrations = McuRegistration::count();
        $completedMcus = McuRegistration::where('status', 'completed')->count();
        $pendingMcus = McuRegistration::whereIn('status', ['pending', 'confirmed'])->count();

        // Get recent registrations
        $recentRegistrations = McuRegistration::with(['user', 'hospital'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Get package distribution
        $packageDistribution = McuRegistration::select('mcu_package', DB::raw('count(*) as total'))
            ->groupBy('mcu_package')
            ->pluck('total', 'mcu_package')
            ->values()
            ->toArray();

        // Get status distribution
        $statusDistribution = McuRegistration::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->values()
            ->toArray();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalRegistrations',
            'completedMcus',
            'pendingMcus',
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
