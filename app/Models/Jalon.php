<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jalon extends Model
{
    use HasFactory;

    protected $table = 'jalons';

    protected $fillable = [
        'Nom_jalon',
        'Description',
        'Statut_jalon',
        'Email',
    ];

    public function activite() {
        return $this->hasMany(Projet::class, 'jalon_id');
    }

}

