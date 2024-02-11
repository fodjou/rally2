<?php

namespace Database\Seeders;

use App\Models\Coureur;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CoureurSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Génération de 10 coureurs fictifs
        for ($i = 0; $i < 10; $i++) {
            Coureur::create([
                'nom_vehicule' => $faker->word,
                'nom_conducteur' => $faker->name,
                'marque' => $faker->company,
                'matricule' => $faker->unique()->randomNumber(6),
                'image' => $faker->imageUrl(),
                'sponsors' => $faker->words(3, true),
                'logo' => $faker->imageUrl(100, 100),
            ]);
        }
    }
}
