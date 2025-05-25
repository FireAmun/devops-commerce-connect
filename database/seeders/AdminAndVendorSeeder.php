<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminAndVendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert admin credentials
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert vendor credentials
        DB::table('users')->insert([
            'name' => 'Vendor User',
            'email' => 'vendor@example.com',
            'role' => 'vendor',
            'password' => Hash::make('vendor123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert vendor details into the vendors table
        DB::table('vendors')->insert([
            'banner' => 'default-banner.jpg',
            'phone' => '1234567890',
            'email' => 'vendor@example.com',
            'address' => '123 Vendor Street',
            'description' => 'This is a sample vendor.',
            'user_id' => DB::getPdo()->lastInsertId(), // Link to the user ID
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
