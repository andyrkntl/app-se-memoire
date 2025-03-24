<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Jalon extends Model
{
    use HasFactory;

    protected $table = 'jalons';

    protected $fillable = [
        'projet_id',
        'nom_jalon',
        'description',
        'date_debut',
        'date_prevue',
        'date_fin',
        'statut_jalon',
    ];

    public function activite()
    {
        return $this->hasMany(Activite::class, 'jalon_id'); //un jalon peut avoir plusieurs activités
    }

    public function projet()
    {
        return $this->belongsTo(Projet::class, 'projet_id');
    }
    public function getColorAttribute()
    {
        return match ($this->statut_jalon) {
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
