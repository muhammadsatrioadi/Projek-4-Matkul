<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::latest()->paginate(10);
        return view('admin.hospitals.index', compact('hospitals'));
    }

    public function create()
    {
        return view('admin.hospitals.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'location' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:hospitals,email',
            'description' => 'required|string',
            'specialties' => 'required|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle specialties
        $specialties = array_map('trim', explode(',', $validated['specialties']));
        $validated['specialties'] = $specialties;

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('hospitals', 'public');
            $validated['image_url'] = $imagePath;
        }

        // Remove the original image field as we're using image_url
        unset($validated['image']);

        // Set default values if not provided
        $validated['rating'] = $validated['rating'] ?? 0;
        $validated['reviews_count'] = $validated['reviews_count'] ?? 0;
        $validated['is_active'] = true;

        Hospital::create($validated);

        return redirect()->route('admin.hospitals.index')
            ->with('success', 'Hospital created successfully.');
    }

    public function edit(Hospital $hospital)
    {
        return view('admin.hospitals.form', compact('hospital'));
    }

    public function update(Request $request, Hospital $hospital)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'location' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:hospitals,email,' . $hospital->id,
            'description' => 'required|string',
            'specialties' => 'required|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle specialties
        $specialties = array_map('trim', explode(',', $validated['specialties']));
        $validated['specialties'] = $specialties;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($hospital->image_url) {
                Storage::disk('public')->delete($hospital->image_url);
            }
            $imagePath = $request->file('image')->store('hospitals', 'public');
            $validated['image_url'] = $imagePath;
        }

        // Remove the original image field as we're using image_url
        unset($validated['image']);

        // Set default values if not provided
        $validated['rating'] = $validated['rating'] ?? $hospital->rating;
        $validated['reviews_count'] = $validated['reviews_count'] ?? $hospital->reviews_count;

        $hospital->update($validated);

        return redirect()->route('admin.hospitals.index')
            ->with('success', 'Hospital updated successfully.');
    }

    public function destroy(Hospital $hospital)
    {
        // Delete hospital image if exists
        if ($hospital->image_url) {
            Storage::disk('public')->delete($hospital->image_url);
        }

        $hospital->delete();

        return redirect()->route('admin.hospitals.index')
            ->with('success', 'Hospital deleted successfully.');
    }
} 