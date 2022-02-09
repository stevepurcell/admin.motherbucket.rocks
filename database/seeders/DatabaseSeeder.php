<?php

namespace Database\Seeders;

use App\Models\Song;
use App\Models\User;
use App\Models\Status;
use App\Models\ContactType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Band Member',
            'email' => 'member@bandman.com',
            'password' => Hash::make('password'),
            'is_admin' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Band Admin',
            'email' => 'admin@bandman.com',
            'password' => Hash::make('password'),
            'is_admin' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Status::create([
            'name' => 'Playable',
            'value' => '1',
            'style' => 'warning',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Status::create([
            'name' => 'In Progress',
            'value' => '2',
            'style' => 'success',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Status::create([
            'name' => 'New',
            'value' => '3',
            'style' => 'primary',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Status::create([
            'name' => 'All Songs',
            'value' => '0',
            'style' => 'dark',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        ContactType::create([
            'name' => 'Venue',
            'style' => 'primary',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        ContactType::create([
            'name' => 'Booker',
            'style' => 'info',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        ContactType::create([
            'name' => 'Bands/Musicians',
            'style' => 'warning',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        ContactType::create([
            'name' => 'Other',
            'style' => 'success',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Song::create([
            'name' => 'Seven Nation Army',
            'artist' => 'White Stripes',
            'status_id' => 1,
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Song::create([
            'name' => 'Backwater',
            'artist' => 'The Meatpuppets',
            'status_id' => 2,
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Song::create([
            'name' => 'You Wreck Me',
            'artist' => 'Tom Petty',
            'status_id' => 2,
            'created_by' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Song::create([
            'name' => 'Blitzkrieg Bop',
            'artist' => 'Ramones',
            'status_id' => 1,
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Song::create([
            'name' => 'Eurotrash Girl',
            'artist' => 'Cracker',
            'status_id' => 1,
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Song::create([
            'name' => 'Learn To Fly',
            'artist' => 'Foo Fighters',
            'status_id' => 1,
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Song::create([
            'name' => 'Steady As She Goes',
            'artist' => 'The Racontours',
            'status_id' => 1,
            'created_by' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Song::create([
            'name' => 'Bound To The Floor',
            'artist' => 'Local H',
            'status_id' => 1,
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Song::create([
            'name' => '10AM Automatic',
            'artist' => 'The Black Keys',
            'status_id' => 1,
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Song::create([
            'name' => 'Are you Gonna Go My Way',
            'artist' => 'Lenny Kravitz',
            'status_id' => 1,
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

