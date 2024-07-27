<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\{Company, User, Client, Vehicle};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (!Company::where('email', 'admin@test.com')->orWhere('name', 'test company')->limit(1)->first()) {
            $Company = Company::create([
                'name' => 'test company',
                'email' => 'admin@test.com',
                'phone' => 'XXXXXXXXXX',
                'address' => 'XXXXXXXXXX',
                'zipcode' => '40000',
                'city' => 'marrakesh',
                'ice' => 'XXXXXXXXXX',
                'license' => 'XXXXXXXXXX',
                'period' => 'week',
                'mileage' => 100
            ]);

            User::create([
                'company' => $Company->id,
                'first_name' => 'john',
                'last_name' => 'doe',
                'email' => 'admin@test.com',
                'phone' => '212999999999',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ]);

            Client::create([
                'first_name' => 'john',
                'last_name' => 'doe',
                'identity' => 'XXXXXXXXXX',
                'identity_type' => 'cin',
                'identity_location' => 'XXXXXXXXXX',
                'identity_date' => now(),
                'nationality' => 'moroccan',
                'license_number' => 'XXXXXXXXXX',
                'license_location' => 'XXXXXXXXXX',
                'license_date' => now(),
                'gender' => 'male',
                'birth_date' => now(),
                'email' => 'test@test.com',
                'phone' => 'XXXXXXXXXX',
                'address' => 'XXXXXXXXXX',
                'company' => $Company->id,
            ]);

            Vehicle::create([
                'price' => 250,
                'passengers' => 4,
                'mileage' => 400,
                'doors' => 4,
                'cargo' => 4,
                'transmission' => 'manual',
                'fuel' => 'diesel',
                'circulation' => now(),
                'company' => $Company->id,
                'brand' => 'smart',
                'model' => 'cabrio',
                'horsepower' => 'less than 8 cv',
                'horsepower_tax' => 700,
                'insurance' => 'insurance 1',
                'insurance_cost' => 1500,
                'registration' => 'XXXXXXXXXX',
                'year' => 2010,
            ]);
        }
    }
}
