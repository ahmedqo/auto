<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
        if (!User::where('email', 'admin@test.com')->limit(1)->first()) {
            User::create([
                'first_name' => 'john',
                'last_name' => 'doe',
                'email' => 'admin@test.com',
                'phone' => '212999999999',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ]);
        }

        foreach ([
            [
                'type' => 'usd_rate',
                'group' => 'currency',
                'content' => '10'
            ],
            [
                'type' => 'eur_rate',
                'group' => 'currency',
                'content' => '10'
            ],
            [
                'type' => 'period',
                'group' => 'core',
                'content' => 'week'
            ], [
                'type' => 'notify_email',
                'group' => 'core',
                'content' => 'notify@test.com'
            ], [
                'type' => 'contact_email',
                'group' => 'contact',
                'content' => 'contact@test.com'
            ], [
                'type' => 'contact_phone',
                'group' => 'contact',
                'content' => 'XXXXXXXXXX'
            ], [
                'type' => 'print_email',
                'group' => 'print',
                'content' => 'print@test.com'
            ], [
                'type' => 'print_phone',
                'group' => 'print',
                'content' => 'XXXXXXXXXX'
            ], [
                'type' => 'instagram',
                'group' => 'social',
                'content' => ''
            ], [
                'type' => 'telegram',
                'group' => 'social',
                'content' => ''
            ], [
                'type' => 'facebook',
                'group' => 'social',
                'content' => ''
            ], [
                'type' => 'youtube',
                'group' => 'social',
                'content' => ''
            ], [
                'type' => 'tiktok',
                'group' => 'social',
                'content' => ''
            ], [
                'type' => 'x',
                'group' => 'social',
                'content' => ''
            ],
        ] as $arr) {
            if (!Setting::where('type', $arr['type'])->limit(1)->first())
                Setting::create($arr);
        }
    }
}
