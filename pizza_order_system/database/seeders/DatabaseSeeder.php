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
            'gender'=>'female',
            'password'=>Hash::make('admin12345'),
        ]);
        User::create([
            'name'=>'moeminthway',
            'email'=>'moeminthway@gmail.com',
            'phone'=>'0987134193',
            'address'=>'Yangon',
            'role'=>'admin',
            'gender'=>'female',
            'password'=>Hash::make('moeminthway'),
        ]);
        User::create([
            'name'=>'zawzaw',
            'email'=>'zawzaw@gmail.com',
            'phone'=>'0987134193',
            'address'=>'Yangon',
            'role'=>'admin',
            'gender'=>'female',
            'password'=>Hash::make('zawzaw'),
        ]);
        User::create([
            'name'=>'sithu',
            'email'=>'sithu@gmail.com',
            'phone'=>'0987134193',
            'address'=>'Yangon',
            'role'=>'admin',
            'gender'=>'male',
            'password'=>Hash::make('sithu'),
        ]);
        User::create([
            'name'=>'user',
            'email'=>'user@gmail.com',
            'phone'=>'0976598431',
            'address'=>'Mandalay',
            'role'=>'user',
            'gender'=>'male',
            'password'=>Hash::make('user12345'),
        ]);
        User::create([
            'name'=>'moemoe',
            'email'=>'moemoe@gmail.com',
            'phone'=>'0976598431',
            'address'=>'Mandalay',
            'role'=>'user',
            'gender'=>'male',
            'password'=>Hash::make('moe'),
        ]);
    }
}
