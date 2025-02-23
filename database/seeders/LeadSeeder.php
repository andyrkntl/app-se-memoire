<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('leads')->insert([
            [
                'Nom_lead'=>'Flavien',
                'Poste'=>'Directeur',
                'Contact'=>'68950230',
                'Direction'=>'directeur',
            ],

            [
                'Nom_lead'=>'Arson',
                'Poste'=>'Directeur',
                'Contact'=>'563950230',
                'Direction'=>'directeur',
            ],

            [
                'Nom_lead'=>'Rado',
                'Poste'=>'Directeur',
                'Contact'=>'341950230',
                'Direction'=>'directeur',
            ],

            [
                'Nom_lead'=>'my hanta ',
                'Poste'=>'Directeur',
                'Contact'=>'014950230',
                'Direction'=>'assistante',
            ],

            [
                'Nom_lead'=>'patrick',
                'Poste'=>'Directeur',
                'Contact'=>'3678950230',
                'Direction'=>'assistant',
            ],

            [
                'Nom_lead'=>'Ericka',
                'Poste'=>'Directeur',
                'Contact'=>'97850230',
                'Direction'=>'Responsable informatique ',
            ],

            [
                'Nom_lead'=>'Lucien',
                'Poste'=>'Directeur',
                'Contact'=>'777950230',
                'Direction'=>'directeur',
            ],
        ]);
    }
}
