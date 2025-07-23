<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Content;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::Create([
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        // Content::factory(100)->create();
    }
}
