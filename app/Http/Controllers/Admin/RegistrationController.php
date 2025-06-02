<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\McuRegistration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $registrations = McuRegistration::with(['user', 'hospital'])
            ->latest()
            ->paginate(10);
        return view('admin.registrations.index', compact('registrations'));
    }

    public function show(McuRegistration $registration)
    {
        $registration->load(['user', 'hospital']);
        return view('admin.registrations.show', compact('registration'));
    }

    public function update(Request $request, McuRegistration $registration)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,confirmed,completed,cancelled'],
            'notes' => ['nullable', 'string'],
        ]);

        $registration->update($validated);

        return redirect()->route('admin.registrations.index')
            ->with('success', 'Registration status updated successfully.');
    }

    public function destroy(McuRegistration $registration)
    {
        $registration->delete();

        return redirect()->route('admin.registrations.index')
            ->with('success', 'Registration deleted successfully.');
    }
} 