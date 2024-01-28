<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'phone'=>'0987134193',
            'address'=>'Yangon',
            'role'=>'admin',
            'password'=>Hash::make('admin12345'),
        ]);
        User::create([
            'name'=>'user',
            'email'=>'user@gmail.com',
            'phone'=>'0976598431',
            'address'=>'Mandalay',
            'role'=>'user',
            'password'=>Hash::make('user12345'),
        ]);
    }
}
