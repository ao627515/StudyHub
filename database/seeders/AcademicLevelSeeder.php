<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("academic_levels")->insert([
            [
                'name' => 'Licence 1',
                'description' => 'First year of undergraduate studies, focusing on foundational knowledge in the chosen field of study.',
                'abb' => 'l1'
            ],
            [
                'name' => 'Licence 2',
                'description' => 'Second year of undergraduate studies, building upon core subjects and introducing more advanced concepts.',
                'abb' => 'l3'
            ],
            [
                'name' => 'Licence 3',
                'description' => 'Final year of undergraduate studies, often involving research or project work and preparing for professional life or further studies.',
                'abb' => 'l3'
            ],
            [
                'name' => 'Master 1',
                'description' => 'First year of postgraduate studies, focusing on specialized subjects and advanced theory in the field of study.',
                'abb' => 'm1'
            ],
            [
                'name' => 'Master 2',
                'description' => 'Second and final year of postgraduate studies, including a thesis or final project, preparing students for high-level professional roles or doctoral studies.',
                'abb' => 'm2'
            ],
            [
                'name' => 'Doctorate 1',
                'description' => 'First year of doctoral research, focusing on the development of research skills and the initiation of a dissertation project.',
                'abb' => 'd1'
            ],
            [
                'name' => 'Doctorate 2',
                'description' => 'Second year of doctoral studies, deepening research and starting to produce significant academic contributions.',
                'abb' => 'd2'
            ],
            [
                'name' => 'Doctorate 3',
                'description' => 'Final year of doctoral research, culminating in the completion of a dissertation and defense, preparing for academic or research-oriented careers.',
                'abb' => 'd3'
            ],
        ]);
    }
}
