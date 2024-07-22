<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\Setting;
use App\Models\User;
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
                'phone' => 'xxxxxxxxxx',
                'address' => 'xxxxxxxxxx',
                'period' => 'week',
                'milage' => 100
            ]);

            User::create([
                'company' => $Company->id,
                'first_name' => 'john',
                'last_name' => 'doe',
                'email' => 'admin@test.com',
                'phone' => '212999999999',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ]);
        }

        $Company = Company::create([
            'name' => 'test company 2',
            'email' => 'admin2@test.com',
            'phone' => 'xxxxxxxxxx',
            'address' => 'xxxxxxxxxx',
            'period' => 'week',
            'milage' => 100
        ]);

        User::create([
            'company' => $Company->id,
            'first_name' => 'john',
            'last_name' => 'doe',
            'email' => 'admin2@test.com',
            'phone' => '212999999929',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);
    }
}
