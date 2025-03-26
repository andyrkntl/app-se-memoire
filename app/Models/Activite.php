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
        return $this->date_fin ? Carbon::parse($this->date_fin)->format('d/m/Y') : '';
    }

    protected $casts = [
        'date_debut' => 'datetime',
        'date_prevue' => 'datetime',
        'date_fin' => 'datetime',
    ];




    public function setStatutActiviteAttribute($value)
    {
        $this->attributes['statut_activite'] = $value;

        // Si le statut devient "Achevé", on met à jour la date_fin
        if ($value === 'Achevé' && is_null($this->date_fin)) {
            $this->attributes['date_fin'] = Carbon::now();
        }

        // Si l'activité n'est pas achevée et que la date prévue est dépassée, elle est en retard
        if ($value !== 'Achevé' && Carbon::now()->greaterThan($this->date_prevue)) {
            $this->attributes['statut_activite'] = 'En retard';
        }
    }


    protected static function boot()
    {
        parent::boot();

        static::saved(function ($activite) {
            $activite->load('jalon');
            if ($activite->jalon) {
                $activite->jalon->updateJalonProgress();
                // Mettre à jour le projet associé
                $projet = $activite->jalon->projet;
                $projet->updateSituations();
            }
        });

        static::deleted(function ($activite) {
            $jalon = $activite->jalon;
            if ($jalon) {
                $jalon->updateJalonProgress();
                // Mettre à jour le projet associé
                $projet = $jalon->projet;
                $projet->updateSituations();
            }
        });

        static::updated(function ($activite) {
            $activite->jalon->updateJalonProgress();
        });
    }
}
