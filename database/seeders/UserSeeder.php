<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@healthnav.com',
            'password' => Hash::make('admin123'),
            'phone' => '081234567890',
            'passport' => 'ADMIN123',
            'address' => 'Jl. Admin Raya No. 1, Jakarta Pusat',
            'role' => 'admin',
        ]);

        // Create regular user
        User::create([
            'name' => 'John Doe',
            'email' => 'john@healthnav.com',
            'password' => Hash::make('user123'),
            'phone' => '081234567891',
            'passport' => 'USER123',
            'address' => 'Jl. User Raya No. 2, Jakarta Selatan',
            'role' => 'user',
        ]);

        // Create test users
        $cities = ['Jakarta Barat', 'Jakarta Timur', 'Jakarta Utara', 'Bandung', 'Surabaya'];
        
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Test User {$i}",
                'email' => "test{$i}@healthnav.com",
                'password' => Hash::make('test123'),
                'phone' => '08' . rand(1000000000, 9999999999),
                'passport' => 'TEST' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'address' => 'Jl. Test Raya No. ' . $i . ', ' . $cities[array_rand($cities)],
                'role' => 'user',
            ]);
        }
    }
}
