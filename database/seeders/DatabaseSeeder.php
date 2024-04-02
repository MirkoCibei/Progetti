<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Announcement;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'A-team',
            'email' => 'ateam@example.it',
            'password' => 'ateam123',
        ]);

        User::factory()->create([
            'name' => 'John Hannibal Smith ',
            'email' => 'hannibal@example.it',
            'password' => 'hannibal123',
        ]);

        User::factory()->create([
            'name' => 'Antoinette Stamm',
            'email' => 'lizzie12@example.org',
            'password' => 'lizzie123',
        ]);

        User::factory()->create([
            'name' => 'Maudie Brown',
            'email' => 'easter.rogahn@example.org',
            'password' => 'easter123',
        ]);


        User::factory()->create([
            'name' => 'Jaleel Johnson',
            'email' => 'buckridge.franco@example.net',
            'password' => 'buckridge123',
        ]);

        User::factory()->create([
            'name' => 'Amira Hayes',
            'email' => 'amira@example.net',
            'password' => 'amira123',
        ]);

        User::factory()->create([
            'name' => 'Gust Beatty',
            'email' => 'gust@example.net',
            'password' => 'gust1234',
        ]);

        User::factory()->create([
            'name' => 'Mr. Cloyd Herzog',
            'email' => 'cloyd@example.net',
            'password' => 'cloyd1234',
        ]);


        User::factory()->create([
            'name' => 'Garrison Kovacek',
            'email' => 'garrison@example.net',
            'password' => 'garrison123',
        ]);

        User::factory()->create([
            'name' => 'Carroll Wolf',
            'email' => 'carroll@example.net',
            'password' => 'carroll123',
        ]);


        // User::factory(25)->create();


        // Announcement::factory(40)->create();


    }
}
