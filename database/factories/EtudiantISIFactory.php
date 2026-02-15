<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EtudiantISIFactory extends Factory
{
    public function definition(): array
    {
        return [
            'matricule' => 'ISI' . fake()->unique()->numberBetween(2024001, 2024999),
            'nom' => fake()->lastName(),
            'prenom' => fake()->firstName(),
            'email' => fake()->unique()->safeEmail(),
            'tel' => fake()->optional()->phoneNumber(),
            'date_naissance' => fake()->date('Y-m-d', '2005-12-31'),
            'statut' => fake()->boolean(80), // 80% chance of being true
        ];
    }
}

