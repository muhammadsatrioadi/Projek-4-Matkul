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
        User::firstOrCreate(
            ['email' => 'admin@healthnav.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'),
                'phone' => '081234567890',
                'passport' => 'ADMIN123',
                'address' => 'Jl. Admin Raya No. 1, Jakarta Pusat',
                'role' => 'admin',
            ]
        );

        // Create regular user
        User::firstOrCreate(
            ['email' => 'john@healthnav.com'],
            [
                'name' => 'John Doe',
                'password' => Hash::make('user123'),
                'phone' => '081234567891',
                'passport' => 'USER001',
                'address' => 'Jl. User Raya No. 2, Jakarta Selatan',
                'role' => 'user',
            ]
        );

        // Create regular user
        User::firstOrCreate(
            ['email' => 'abel@gmail.com'],
            [
                'name' => 'Abel',
                'password' => Hash::make('abel123'),
                'phone' => '081234567892',
                'passport' => 'USER002',
                'address' => 'Jl. User Raya No. 3, Jakarta Selatan',
                'role' => 'user',
            ]
        );

        // Create test users
        $cities = ['Jakarta Barat', 'Jakarta Timur', 'Jakarta Utara', 'Bandung', 'Surabaya'];
        
        for ($i = 1; $i <= 5; $i++) {
            User::firstOrCreate(
                ['email' => "test{$i}@healthnav.com"],
                [
                    'name' => "Test User {$i}",
                    'password' => Hash::make('test123'),
                    'phone' => '08' . rand(1000000000, 9999999999),
                    'passport' => 'TEST' . str_pad($i, 3, '0', STR_PAD_LEFT),
                    'address' => 'Jl. Test Raya No. ' . $i . ', ' . $cities[array_rand($cities)],
                    'role' => 'user',
                ]
            );
        }
    }
}
