<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjetPartiePrenante extends Model
{
    use HasFactory;

    protected $table = 'projet_partie_prenante';

    protected $fillable = [
        'projet_id',
        'partie_prenante_id',
        'fonction',
        'nom_partie',
        'email_partie',
        'contact_partie',
    ];

    public function projet()
    {
        return $this->belongsTo(Projet::class, 'projet_id');
    }

    public function partiePrenante()
    {
        return $this->belongsTo(PartiePrenante::class, 'partie_prenante_id');
    }
}
