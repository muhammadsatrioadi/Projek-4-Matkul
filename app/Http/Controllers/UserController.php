<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\McuRegistration;
use App\Models\Hospital;

class UserController extends Controller
{
    public function showLogin()
    {
        return view('auth.user-login');
    }

    public function showRegister()
    {
        return view('auth.user-register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:20'],
            'passport' => ['required', 'string', 'max:50', 'unique:users'],
            'address' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'passport' => $request->passport,
            'address' => $request->address,
            'role' => 'user',
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * Display the user's dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get upcoming appointments
        $upcomingAppointments = McuRegistration::where('user_id', $user->id)
            ->where('appointment_date', '>=', now())
            ->where('status', '!=', 'cancelled')
            ->count();

        // Get completed checkups
        $completedCheckups = McuRegistration::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();

        // Get visited hospitals (unique)
        $visitedHospitals = McuRegistration::where('user_id', $user->id)
            ->distinct('hospital_id')
            ->count('hospital_id');

        // Get pending results
        $pendingResults = McuRegistration::where('user_id', $user->id)
            ->whereIn('status', ['confirmed', 'in_progress'])
            ->count();

        // Get recent appointments
        $recentAppointments = McuRegistration::with('hospital')
            ->where('user_id', $user->id)
            ->orderBy('appointment_date', 'desc')
            ->take(5)
            ->get();

        return view('user.dashboard', compact(
            'upcomingAppointments',
            'completedCheckups',
            'visitedHospitals',
            'pendingResults',
            'recentAppointments'
        ));
    }

    /**
     * Show the user's profile form.
     */
    public function profile()
    {
        return view('user.profile', ['user' => Auth::user()]);
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $user->update($validated);

        return back()->with('status', 'Profile updated successfully!');
    }

    /**
     * Show MCU registration form.
     */
    public function showMcuRegistration()
    {
        $hospitals = \App\Models\Hospital::active()
            ->orderBy('name')
            ->get();

        return view('user.mcu.register', compact('hospitals'));
    }

    /**
     * Store new MCU registration.
     */
    public function storeMcuRegistration(Request $request)
    {
        $request->validate([
            'hospital_id' => 'required|exists:hospitals,id',
            'mcu_package' => 'required|in:basic,standard,premium',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'medical_notes' => 'nullable|string|max:1000'
        ]);

        $registration = new \App\Models\McuRegistration();
        $registration->user_id = auth()->id();
        $registration->hospital_id = $request->hospital_id;
        $registration->registration_number = \App\Models\McuRegistration::generateRegistrationNumber();
        $registration->mcu_package = $request->mcu_package;
        $registration->appointment_date = $request->appointment_date;
        $registration->appointment_time = $request->appointment_time;
        $registration->medical_notes = $request->medical_notes;
        $registration->status = 'pending';
        $registration->total_cost = $this->calculateMcuCost($request->mcu_package);
        $registration->save();

        return redirect()->route('user.mcu.show', $registration->id)
            ->with('success', 'MCU Registration submitted successfully!');
    }

    private function calculateMcuCost($package)
    {
        $costs = [
            'basic' => 500000,
            'standard' => 1000000,
            'premium' => 2500000
        ];

        return $costs[$package] ?? 0;
    }

    /**
     * Show MCU history.
     */
    public function mcuHistory()
    {
        $registrations = McuRegistration::with('hospital')
            ->where('user_id', Auth::id())
            ->orderBy('appointment_date', 'desc')
            ->paginate(10);

        return view('user.mcu.history', compact('registrations'));
    }

    /**
     * Show specific MCU details.
     */
    public function showMcuDetails($id)
    {
        $registration = McuRegistration::with(['hospital', 'medicalRecord'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('user.mcu.show', compact('registration'));
    }
} 