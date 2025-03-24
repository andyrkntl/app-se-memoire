<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Chantier extends Model
{
    use HasFactory;
    protected $table = 'chantiers';

    protected $fillable = [
        'nom_chantier',
        'acronyme',
        'description',
    ];


    public function projet()
    {
        return $this->hasMany(Projet::class, 'chantier_id');
    }
}
