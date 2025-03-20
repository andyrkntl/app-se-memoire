<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartiePrenante extends Model
{
    use HasFactory;
    protected $table = 'partie_prenantes';

    protected $fillable = [
        'entite',
        'fonction',
        'nom_partie',
        'email',
        'contact'
    ];



    public function projet()
    {
        return $this->belongsToMany(Projet::class)
            ->withTimestamps();
    }
}
