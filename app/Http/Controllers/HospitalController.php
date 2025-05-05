<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display the hospital selection page.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function selection(Request $request)
    {
        $query = Hospital::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('specialties', 'like', "%{$search}%");
            });
        }

        // Filter by specialty
        if ($request->has('specialty')) {
            $specialty = $request->get('specialty');
            $query->where('specialties', 'like', "%{$specialty}%");
        }

        // Sort functionality
        $sort = $request->get('sort', 'rating');
        $direction = $request->get('direction', 'desc');
        
        switch ($sort) {
            case 'name':
                $query->orderBy('name', $direction);
                break;
            case 'rating':
                $query->orderBy('rating', $direction);
                break;
            case 'reviews':
                $query->orderBy('reviews_count', $direction);
                break;
            default:
                $query->orderBy('rating', 'desc');
        }

        // Get all unique specialties for the filter dropdown
        $allSpecialties = [];
        $specialtiesData = Hospital::pluck('specialties');
        
        foreach ($specialtiesData as $specialtiesJson) {
            $specialtiesArray = is_string($specialtiesJson) ? json_decode($specialtiesJson, true) : $specialtiesJson;
            if (is_array($specialtiesArray)) {
                $allSpecialties = array_merge($allSpecialties, $specialtiesArray);
            }
        }
        
        $specialties = array_unique($allSpecialties);

        $hospitals = $query->paginate(9);

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
            'doctors_count' => $hospital->doctors_count ?? 0,
            'success_rate' => $hospital->success_rate ?? 0,
        ]);
    }
}