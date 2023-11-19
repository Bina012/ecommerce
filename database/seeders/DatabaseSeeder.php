<?php

namespace Database\Seeders;

use App\Models\User;
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
        // \App\Models\User::factory(10)->create();
        // User::create(['name' => 'Ramu','email' => 'ramu@gmail.com','password' => Hash::make('ramu123456')]);
        User::create(['name' => 'Hari','email' => 'hari@gmail.com','password' => Hash::make('hari123456')]);
    }
}
