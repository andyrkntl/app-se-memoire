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
        'taux_avancement',
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
        return $this->date_fin ? Carbon::parse($this->date_fin)->format('d/m/Y') : '';
    }


    public function updateJalonProgress()
    {
        // Recharger les activités depuis la base pour éviter le cache
        $this->load('activite');
        $activites = $this->activite;

        if ($activites->isEmpty()) {
            $this->update([
                'taux_avancement' => 0,
                'statut_jalon' => 'En cours',
                'date_debut' => null,
                'date_prevue' => null,
                'date_fin' => null,
            ]);
            return;
        }

        // Calcul précis des activités achevées
        $activitesAchevees = $activites->filter(function ($activite) {
            return $activite->statut_activite === 'Achevé';
        })->count();

        $totalActivites = $activites->count();
        $tauxAvancement = $totalActivites > 0
            ? round(($activitesAchevees / $totalActivites) * 100, 2)
            : 0;

        // Détermination du statut avec vérification temporelle
        $statut = 'En cours';
        $dateLimiteDepassee = Carbon::now()->gt($activites->max('date_prevue'));

        if ($activitesAchevees === $totalActivites) {
            $statut = 'Achevé';
        } elseif ($dateLimiteDepassee) {
            $statut = 'En retard';
        }

        // Mise à jour atomique
        $this->update([
            'taux_avancement' => $tauxAvancement,
            'statut_jalon' => $statut,
            'date_debut' => $activites->min('date_debut'),
            'date_prevue' => $activites->max('date_prevue'),
            'date_fin' => $statut === 'Achevé' ? Carbon::now() : null
        ]);

        // Forcer le rafraîchissement des données
        $this->refresh();
    }



    protected static function boot()
    {
        parent::boot();

        static::saved(function ($jalon) {
            $jalon->load('projet');
            $jalon->projet?->updateProjetProgress();
        });

        static::updated(function ($jalon) {
            $jalon->load('projet');
            $jalon->projet?->updateProjetProgress();
        });

        static::deleted(function ($jalon) {
            $jalon->load('projet');
            $jalon->projet?->updateProjetProgress();
        });
    }
}
