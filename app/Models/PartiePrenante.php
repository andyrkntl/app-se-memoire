<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartiePrenante extends Model
{
    use HasFactory;
    protected $table = 'partie_prenantes';

    protected $fillable = [
       'Nom_partie',
        'Acronyme',
        'Type',
        'Contact',
    ];



    public function projet() {
        return $this->hasMany(Projet::class, 'partiePrenante_id');
    }
}
