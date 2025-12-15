<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Category::factory(5)->create();
        \App\Models\Post::factory(20)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@ugtm.com',
            'password' => bcrypt('password'),
        ]);
    }
}
