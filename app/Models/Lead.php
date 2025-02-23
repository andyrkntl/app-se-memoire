<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $table = 'leads';

    protected $fillable = [
        'Nom_lead',
        'Poste',
        'Contact',
        'Email',
    ];

    public function projet()
    {
        return $this->hasMany(Projet::class, 'lead_id');
    }
}
