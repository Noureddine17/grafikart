<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bien>
 */
class BienFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $files = Storage::disk('public')->files('apart');

        $randomFile = $files[rand(0, count($files) - 1)];        
        return [
            'title' => fake()->sentence(),
            'surface' => rand(100, 1000),
            'prix' => rand(100000, 1000000),
            'description' => fake()->paragraph(),
            'pieces' => rand(1, 10),
            'etage' => rand(0, 10),
            'address' => fake()->streetAddress(),
            'ville' => fake()->city(),
            'code_postal' => rand(10000, 99999),
            'options' => implode(',', fake()->words(rand(1, 5))),
            'images' => $randomFile,
            'chambre' => rand(0,10),
            'vendue' => false,
        ];
    }
}