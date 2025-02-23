<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('partie_prenantes')->insert([
            [
                'Nom_partie'=>'MEF',
                'accronime_partie'=>'MEF',
                'Responsable'=>'Minha',
                'Direction'=>'Communication',
            ],

            [
                'Nom_partie'=>'PREA',
                'accronime_partie'=>'PREA',
                'Responsable'=>'Moumou',
                'Direction'=>'IT',

            ],

            [
                'Nom_partie'=>'UE',
                'accronime_partie'=>'UE',
                'Responsable'=>'Fanilo',
                'Direction'=>'Finance',
            ],

            [
                'Nom_partie'=>'MINJUS',
                'accronime_chantier'=>'MINJUS',
                'Responsable'=>'Nomenjanahary',
                'Direction'=>'RH',
            ],
        ]);
    }
}
