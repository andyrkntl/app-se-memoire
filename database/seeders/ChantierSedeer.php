<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChantierSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chantiers')->insert([
            [
                'Nom_chantier'=>'RECI',
                'accronime_chantier'=>' REFORME DE L\'ETAT CIVIL ET DE L\'IDENTITE',
            ],
            [
                'Nom_chantier'=>'CMIL ',
                'accronime_chantier'=>'Commission Malagasy de l\'Informatique et des Libertés ',
            ],
            [
                'Nom_chantier'=>'SIGOB',
                'accronime_chantier'=>'SIGOB',
            ],
            [
                'Nom_chantier'=>'SAFI ',
                'accronime_chantier'=>'SAFI',
            ],
            [
                'Nom_chantier'=>'E-GP',
                'accronime_chantier'=>'Electronic Gouvernment Procurement',
            ],
            [
                'Nom_chantier'=>'AUGURE',
                'accronime_chantier'=>'AUGURE',
            ],
            [
                'Nom_chantier'=>'LOGICIVIL TPI',
                'accronime_chantier'=>'LOGICIVIL TPI',
            ],
            [
                'Nom_chantier'=>'TDMFP',
                'accronime_chantier'=>'TRANSFORMATION DIGITALE DES MÉTIERS DES FINANCES PUBLIQUES',
            ],
        ]);
    }
}
