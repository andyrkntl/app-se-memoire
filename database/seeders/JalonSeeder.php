<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JalonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jalons')->insert([

            ['Nom_jalon'=>'A'],
            ['Nom_jalon'=>'B'],
            ['Nom_jalon'=>'C'],
            ['Nom_jalon'=>'D'],
            ['Nom_jalon'=>'E'],
            ['Nom_jalon'=>'F'],
            ['Nom_jalon'=>'G'],
            ['Nom_jalon'=>'H'],
            ['Nom_jalon'=>'I'],
            ['Nom_jalon'=>'J'],
            ['Nom_jalon'=>'K'],
        ]);
    }
}
