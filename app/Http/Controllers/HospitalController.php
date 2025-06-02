<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HospitalController extends Controller
{
    /**
     * Display a listing of the hospitals.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $hospitals = Hospital::active()
            ->orderBy('name')
            ->paginate(12);
            
        return view('hospitals.index', compact('hospitals'));
    }

    /**
     * Display the hospital selection page.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function selection(Request $request)
    {
        $query = Hospital::query()->active();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by specialty
        if ($request->filled('specialty')) {
            $specialty = $request->get('specialty');
            $query->whereJsonContains('specialties', $specialty);
        }

        // Sort functionality
        $sort = $request->get('sort', 'rating');
        $direction = $request->get('direction', 'desc');
        
        switch ($sort) {
            case 'name':
                $query->orderBy('name', $direction);
                break;
            case 'rating':
                $query->orderBy('rating', $direction)
                      ->orderBy('reviews_count', 'desc');
                break;
            case 'reviews':
                $query->orderBy('reviews_count', $direction)
                      ->orderBy('rating', 'desc');
                break;
            default:
                $query->orderBy('rating', 'desc')
                      ->orderBy('reviews_count', 'desc');
        }

        // Get all unique specialties for the filter dropdown
        $specialties = Cache::remember('hospital_specialties', 3600, function () {
            $allSpecialties = [];
            Hospital::active()->pluck('specialties')->each(function ($specialtiesJson) use (&$allSpecialties) {
                $specialtiesArray = is_string($specialtiesJson) ? json_decode($specialtiesJson, true) : $specialtiesJson;
                if (is_array($specialtiesArray)) {
                    $allSpecialties = array_merge($allSpecialties, $specialtiesArray);
                }
            });
            return array_values(array_unique($allSpecialties));
        });

        $hospitals = $query->paginate(9)->withQueryString();

        return view('hospitals.selection', compact('hospitals', 'specialties'));
    }

    /**
     * Display the specified hospital's details.
     *
     * @param Hospital $hospital
     * @return \Illuminate\View\View
     */
    public function show(Hospital $hospital)
    {
        abort_if(!$hospital->is_active, 404);
        return view('hospitals.show', compact('hospital'));
    }

    /**
     * Get hospital details for AJAX requests.
     *
     * @param Hospital $hospital
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDetails(Hospital $hospital)
    {
        abort_if(!$hospital->is_active, 404);

        $specialties = is_string($hospital->specialties) 
            ? json_decode($hospital->specialties, true) 
            : ($hospital->specialties ?? []);
            
        $facilities = is_string($hospital->facilities) 
            ? json_decode($hospital->facilities, true) 
            : ($hospital->facilities ?? []);

        return response()->json([
            'hospital' => $hospital,
            'specialties' => $specialties,
            'facilities' => $facilities,
            'doctors_count' => $hospital->doctors()->count(),
            'success_rate' => $hospital->success_rate ?? 95,
        ]);
    }
}