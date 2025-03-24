<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Activite extends Model
{
    use HasFactory;

    protected $table = 'activites';

    protected $fillable = [
        'jalon_id',
        'nom_activite',
        'date_debut',
        'date_prevue',
        'date_fin',
        'statut_activite',

    ];

    public function jalon()
    {
        return $this->belongsTo(Jalon::class, 'jalon_id'); //une activité appartient à un seul jalon
    }
    public function getColorAttribute()
    {
        return match ($this->statut_activite) {
            'En cours' => 'blue',
            'Achevé' => 'green',
            'En retard' => 'red',
            default => 'black',
        };
    }

    public function getDateDebutFormattedAttribute()
    {
        return Carbon::parse($this->date_debut)->format('d/m/Y');
    }


    public function getDatePrevueFormattedAttribute()
    {
        return Carbon::parse($this->date_prevue)->format('d/m/Y');
    }


    public function getDateFinFormattedAttribute()
    {
        return Carbon::parse($this->date_fin)->format('d/m/Y');
    }
}
