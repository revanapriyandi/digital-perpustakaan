<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\CategoryBook;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'username' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

        CategoryBook::factory(15)->create();
        Book::factory(50)->create();
    }
}
