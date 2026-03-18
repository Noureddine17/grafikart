<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Bien;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

   
        Bien::factory(10)->create();


        // DB::table('biens')->insert([
        //     'title' => Str::random(10),
        //     'surface' => rand(100, 1000),
        //     'prix' => rand(100000, 1000000),
        //     'description' => Str::random(100),
        //     'pieces' => rand(1, 10),
        //     'etage' => rand(1, 10),
        //     'address' => Str::random(10),
        //     'ville' => Str::random(10),
        //     'code_postal' => rand(10000, 99999),
        //     'options' => Str::random(10),
        //     'images' => Str::random(10),
        //     'chambre' => Str::random(10),
        //     'vendue' => false,
        // ]);



    }
}
