<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category_resources')->insert([
            [
                'name' => 'TD',
                'description' => 'Travaux dirigés, exercices pratiques pour approfondir les concepts théoriques vus en cours.'
            ],
            [
                'name' => 'TP',
                'description' => 'Travaux pratiques permettant aux étudiants de manipuler et d’appliquer les concepts techniques dans un environnement contrôlé.'
            ],
            // [
            //     'name' => 'Cours',
            //     'description' => 'Cours théoriques couvrant les notions fondamentales et avancées d’un sujet donné.'
            // ],
            [
                'name' => 'Recueil De Devoir',
                'description' => 'Collection de devoirs précédents, utilisés pour la révision et la préparation des examens.'
            ],
            [
                'name' => 'Livre',
                'description' => 'Livres académiques et manuels de référence pour approfondir la compréhension des matières.'
            ]
        ]);
    }
}