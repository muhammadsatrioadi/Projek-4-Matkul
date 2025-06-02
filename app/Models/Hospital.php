<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'address',
        'phone',
        'email',
        'description',
        'image_url',
        'rating',
        'reviews_count',
        'specialties',
        'facilities',
        'is_active'
    ];

    protected $casts = [
        'specialties' => 'array',
        'facilities' => 'array',
        'is_active' => 'boolean',
        'rating' => 'float'
    ];

    /**
     * Get the full image URL for the hospital.
     */
    public function getImageUrlAttribute($value)
    {
        if (!$value) {
            return asset('assets/images/default-hospital.jpg');
        }
        return asset('storage/' . $value);
    }

    /**
     * Get the MCU registrations for the hospital.
     */
    public function mcuRegistrations(): HasMany
    {
        return $this->hasMany(McuRegistration::class);
    }

    /**
     * Scope a query to only include active hospitals.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to filter hospitals by specialty.
     */
    public function scopeHasSpecialty($query, $specialty)
    {
        return $query->whereJsonContains('specialties', $specialty);
    }

    /**
     * Scope a query to search hospitals by name or location.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
        });
    }
}
