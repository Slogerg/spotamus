<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed
        // \App\Models\User::factory(10)->create();

        \App\Models\User::insert([
            'name' => 'Admin',
            'email' => 'antonslogerg@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        \App\Models\Artist::factory(10)->create();
        \App\Models\Genre::factory(10)->create();
        \App\Models\Ticket::factory(4)->create();
        \App\Models\Venue::factory(10)->create();
    }
}
