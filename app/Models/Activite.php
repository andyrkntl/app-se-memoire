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
        'lieu_reunion',
        'heure_reunion',
        'description_reunion',
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
        if ($value !== 'Achevé' && Carbon::now()->greaterThan($this->date_prevue->endOfDay())) {
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


    public static function getNotifications()
    {
        $now = Carbon::now();
        $today = $now->copy()->startOfDay(); // Pour comparer juste la date du jour
        $in15Days = $now->copy()->addDays(15);
        $in7Days = $now->copy()->addDays(7);
        $in3Days = $now->copy()->addDays(3);
        $in1Day = $now->copy()->addDay();

        return self::where(function ($query) use ($now, $today, $in15Days, $in7Days, $in3Days, $in1Day) {
            $query->where('statut_activite', '!=', 'Achevé')
                ->where(function ($subquery) use ($now, $today, $in15Days, $in7Days, $in3Days, $in1Day) {
                    $subquery->whereDate('date_prevue', '<', $now) // en retard
                        ->orWhereDate('date_prevue', '=', $today) // jour J (aujourd'hui)
                        ->orWhereDate('date_prevue', '=', $in15Days) // 15 jours avant
                        ->orWhereDate('date_prevue', '=', $in7Days)  // 7 jours avant
                        ->orWhereDate('date_prevue', '=', $in3Days)  // 3 jours avant
                        ->orWhereDate('date_prevue', '=', $in1Day); // 1 jour avant
                });
        })
            ->orWhereNotNull('heure_reunion') // Réunions planifiées
            ->get();
    }
}
