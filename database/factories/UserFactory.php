<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'role' => 'user',
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }
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





















    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
