<?php

namespace Database\Seeders;

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
            'name' => 'Steve Purcell',
            'email' => 'smp103@gmail.com',
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
            'name' => 'Good To Go',
            'value' => '2',
            'style' => 'success',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Status::create([
            'name' => 'Kick Ass',
            'value' => '3',
            'style' => 'danger',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Status::create([
            'name' => 'New Song',
            'value' => '4',
            'style' => 'primary',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Status::create([
            'name' => 'Backburner',
            'value' => '5',
            'style' => 'info',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Status::create([
            'name' => 'Possibilities',
            'value' => '6',
            'style' => 'secondary',
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
    }
}
