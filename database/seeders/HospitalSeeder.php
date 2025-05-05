<?php

namespace Database\Seeders;

use App\Models\Hospital;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hospitals = [
            [
                'name' => 'City General Hospital',
                'address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
                'location' => 'Jakarta Pusat',
                'phone' => '(021) 555-0123',
                'email' => 'info@citygeneral.com',
                'description' => 'Leading healthcare facility with state-of-the-art equipment and expert medical staff.',
                'rating' => 4.8,
                'reviews_count' => 520,
                'specialties' => ['general', 'cardiac', 'orthopedic'],
                'is_active' => true
            ],
            [
                'name' => "St. Mary's Medical Center",
                'address' => 'Jl. Gatot Subroto No. 456, Jakarta Selatan',
                'location' => 'Jakarta Selatan',
                'phone' => '(021) 555-0124',
                'email' => 'info@stmarys.com',
                'description' => 'Specialized in cardiac care and emergency services with 24/7 availability.',
                'rating' => 4.6,
                'reviews_count' => 380,
                'specialties' => ['cardiac', 'emergency'],
                'is_active' => true
            ],
            [
                'name' => "Children's Hope Hospital",
                'address' => 'Jl. Thamrin No. 789, Jakarta Pusat',
                'location' => 'Jakarta Pusat',
                'phone' => '(021) 555-0125',
                'email' => 'info@childrenshope.com',
                'description' => 'Dedicated pediatric care facility with child-friendly environment and specialists.',
                'rating' => 4.9,
                'reviews_count' => 450,
                'specialties' => ['pediatric', 'general'],
                'is_active' => true
            ],
            [
                'name' => 'Orthopedic Specialty Center',
                'address' => 'Jl. Asia Afrika No. 234, Jakarta Barat',
                'location' => 'Jakarta Barat',
                'phone' => '(021) 555-0126',
                'email' => 'info@orthocenter.com',
                'description' => 'Specialized in orthopedic care with advanced treatment options and rehabilitation services.',
                'rating' => 4.7,
                'reviews_count' => 320,
                'specialties' => ['orthopedic', 'rehabilitation'],
                'is_active' => true
            ],
            [
                'name' => 'Central Medical Hospital',
                'address' => 'Jl. Hayam Wuruk No. 567, Jakarta Pusat',
                'location' => 'Jakarta Pusat',
                'phone' => '(021) 555-0127',
                'email' => 'info@centralmedical.com',
                'description' => 'Comprehensive healthcare services with multiple specialties under one roof.',
                'rating' => 4.5,
                'reviews_count' => 600,
                'specialties' => ['general', 'cardiac', 'pediatric', 'orthopedic'],
                'is_active' => true
            ]
        ];

        foreach ($hospitals as $hospital) {
            Hospital::create($hospital);
        }
    }
} 