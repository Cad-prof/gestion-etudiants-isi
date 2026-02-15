<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EtudiantISI;

class EtudiantISISeeder extends Seeder
{
    public function run(): void
    {
        // Create 20 fake students
        EtudiantISI::factory(20)->create();
    }
}

