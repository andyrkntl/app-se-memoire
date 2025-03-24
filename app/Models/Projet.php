<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Projet extends Model
{
    use HasFactory;
    protected $table = 'projets';

    protected $fillable = [
        'nom_projet',
        'objectifs',
        'situation_actuelle',
        'prochaines_etapes',
        'date_debut',
        'date_fin',
        'statut_projet',
    ];


    public function chantier()
    {
        return $this->belongsTo(Chantier::class, 'chantier_id');
    }

    public function jalon()
    {
        return $this->hasMany(Jalon::class, 'projet_id');
    }

    public function partiePrenante()
    {
        return $this->belongsToMany(PartiePrenante::class, 'projet_partie_prenante')
            ->withPivot(['fonction', 'nom_partie', 'email_partie', 'contact_partie'])
            ->withTimestamps();
    }

    public function activite()
    {
        return $this->hasManyThrough(Activite::class, Jalon::class);
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    public function getColorAttribute()
    {
        return match ($this->statut_projet) {
            'En cours' => 'blue',
            'Achevé' => 'green',
            'En retard' => 'red'
        };
    }

    public function getDateDebutFormattedAttribute()
    {
        return Carbon::parse($this->date_debut)->format('d/m/Y');
    }

    public function getDateFinFormattedAttribute()
    {
        return Carbon::parse($this->date_fin)->format('d/m/Y');
    }
}
