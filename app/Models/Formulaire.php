<?php
// app/Models/Formulaire.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulaire extends Model
{
    use HasFactory;

    protected $table = 'formulaire';

    protected $fillable = [
        'nom_chantier',
        'pourcentage_realisation',
        'commentaires',
    ];
}
