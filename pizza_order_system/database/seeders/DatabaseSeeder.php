<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
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
            'password'=>Hash::make('admin123'),
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
        Category::create([
            'name'=>'foods',
        ]);
        Category::create([
            'name'=>'drinks',
        ]);
        Category::create([
            'name'=>'pizza',
        ]);
        Category::create([
            'name'=>'snaps',
        ]);

         Product::create([
            'category_id'=>"1",
            'name'=>"noodle ",
            'description'=>"noodle  is so good" ,
            'price'=>"3000" ,
        ]);
         Product::create([
            'category_id'=>"1",
            'name'=>" fried rice ",
            'description'=>" fried rice  is so good" ,
            'price'=>"4000" ,
        ]);
         Product::create([
            'category_id'=>"2",
            'name'=>"coca cola",
            'description'=>"coca cola is so good" ,
            'price'=>"1500" ,
        ]);
         Product::create([
            'category_id'=>"2",
            'name'=>"Orange juice",
            'description'=>"Orange juice is so good" ,
            'price'=>"3500" ,
        ]);
         Product::create([
            'category_id'=>"2",
            'name'=>"juice",
            'description'=>"juice is so good" ,
            'price'=>"2000" ,
        ]);
         Product::create([
            'category_id'=>"3",
            'name'=>"seafood pizza ",
            'description'=>"seafood pizza is so good" ,
            'price'=>"30000" ,
        ]);
         Product::create([
            'category_id'=>"3",
            'name'=>"chicken pizza",
            'description'=>"chicken pizza is so good" ,
            'price'=>"35000" ,
        ]);

            // $table->id();
            // $table->integer('category_id');
            // $table->string('name');
            // $table->longText('description');
            // $table->string('image')->nullable(true);
            // $table->integer('price');
            // $table->integer('waiting_time')->default(0);
            // $table->integer('view_count')->default(0);
            // $table->timestamps();

    }
}
