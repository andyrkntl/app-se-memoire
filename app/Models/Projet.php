<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Projet extends Model
{
    use HasFactory;
    protected $table = 'projets';

    protected $fillable = [
        'nom_projet',
        'objectifs',
        'situation_actuelle',
        'prochaines_etapes',
        'taux_avancement',
        'date_debut',
        'date_fin',
        'statut_projet',
        'chantier_id',
        'lead_id',
    ];


    public function chantier()
    {
        return $this->belongsTo(Chantier::class, 'chantier_id');
    }

    public function jalon()
    {
        return $this->hasMany(Jalon::class, 'projet_id');
    }

    public function document()
    {
        return $this->hasMany(Document::class, 'projet_id');
    }


    public function partiePrenante()
    {
        return $this->belongsToMany(PartiePrenante::class, 'projet_partie_prenante')
            ->withPivot(['fonction', 'nom_partie', 'email_partie', 'contact_partie'])
            ->withTimestamps();
    }

    public function activite()
    {
        return $this->hasManyThrough(
            Activite::class,
            Jalon::class,
        );
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

    public function updateProjetProgress()
    {
        $this->load('jalon');
        $jalons = $this->jalon;

        if ($jalons->isEmpty()) {
            $this->update([
                'taux_avancement' => 0,
                'statut_projet' => 'En cours',
                'date_debut' => null,
                'date_fin' => null,
            ]);
            return;
        }

        // Calcul du taux moyen des jalons
        $tauxMoyen = $jalons->avg('taux_avancement');
        $taux = round($tauxMoyen, 2);


        // Détermination des dates
        $dateDebut = $jalons->min('date_debut');
        $dateFin = $jalons->max(function ($jalon) {
            return $jalon->date_fin ?? $jalon->date_prevue;
        });

        // Détermination du statut
        $statut = 'En cours';
        $tousAcheves = $jalons->every(fn($j) => $j->statut_jalon === 'Achevé');

        if ($tousAcheves) {
            $statut = 'Achevé';
        } elseif (Carbon::now()->gt($dateFin)) {
            $statut = 'En retard';
        }


        $this->update([
            'taux_avancement' => $taux,
            'statut_projet' => $statut,
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin
        ]);

        $this->refresh();
    }



    public function updateSituations()
    {
        Log::info("Mise à jour des situations pour le projet : {$this->id}");
        $today = Carbon::today();

        // Récupérer les 3 dernières activités passées ou en cours
        $situation_actuelle = $this->activite()
            ->where('activites.date_debut', '<=', $today)
            ->whereIn('activites.statut_activite', ['en cours', 'en retard'])
            ->orderBy('activites.date_debut', 'desc')
            ->limit(3)
            ->pluck('nom_activite')
            ->implode('; ');

        // Récupérer les 3 prochaines activités à venir
        $prochaines_etapes = $this->activite()
            ->where('activites.date_debut', '>', $today)
            ->orderBy('activites.date_debut', 'asc')
            ->limit(3)
            ->pluck('nom_activite')
            ->implode('; ');

        // Mettre à jour les champs et sauvegarder
        $this->update([
            'situation_actuelle' => $situation_actuelle,
            'prochaines_etapes' => $prochaines_etapes,
        ]);
    }


    public function getJoursRestantsAttribute()
    {
        $dateFin = Carbon::parse($this->date_fin);
        $maintenant = Carbon::now();

        return $maintenant->diffInDays($dateFin, false); // false permet les valeurs négatives
    }

    public function getJoursRestantsFormattedAttribute()
    {
        $jours = $this->jours_restants;

        if ($jours > 0) {
            return "$jours jours restants";
        } elseif ($jours === 0) {
            return "Dernier jour !";
        } else {
            return "Terminé il y a " . abs($jours) . " jours";
        }
    }
}
