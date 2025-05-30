<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'=>'Flavien',
                'email'=>'fanevatiana@fanevatiana.com',
                'image'=>'/image/prea.png',
                'password'=>hash::make('fanevatiana@fanevatiana.com'),
            ],

        ]);
    }
}
