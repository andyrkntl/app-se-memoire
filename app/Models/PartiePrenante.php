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
    ];



    public function projet()
    {
        return $this->belongsToMany(Projet::class, 'projet_partie_prenante')
            ->withPivot(['fonction', 'nom_partie', 'email_partie', 'contact_partie'])
            ->withTimestamps();
    }
}
