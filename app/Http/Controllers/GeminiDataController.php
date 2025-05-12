<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projet;
use App\Models\Jalon;
use App\Models\Activite;
use App\Models\Chantier;
use App\Models\Lead;
use App\Models\Document;
use Smalot\PdfParser\Parser;

class GeminiDataController extends Controller
{

    public function lirePDF()
    {
        $parser = new Parser();
        $pdf = $parser->parseFile(storage_path('app/plan/ps_prea.pdf'));

        $text = $pdf->getText();

        return $text;
    }





    public function collectData()
    {
        $rapport = "Données globales du système :\n\n";

        // On charge tous les éléments nécessaires avec les relations
        $chantiers = Chantier::with([
            'projet.jalon.activite',
            'projet.lead',
            'projet.partiePrenante'
        ])->get();

        foreach ($chantiers as $chantier) {
            $rapport .= " Chantier : {$chantier->nom_chantier} ({$chantier->acronyme})\n";
            $rapport .= "Description : {$chantier->description}\n";

            foreach ($chantier->projet as $projet) {
                $rapport .= "\n   Projet : {$projet->nom_projet}\n";
                $rapport .= "  - Taux d'avancement : {$projet->taux_avancement}%\n";
                $rapport .= "  - Statut : {$projet->statut_projet}\n";
                $rapport .= "  - Objectifs : {$projet->objectifs}\n";
                if ($projet->situation_actuelle) {
                    $rapport .= "  - Situation actuelle : {$projet->situation_actuelle}\n";
                }
                if ($projet->prochaines_etapes) {
                    $rapport .= "  - Prochaines étapes : {$projet->prochaines_etapes}\n";
                }

                //  Lead du projet
                if ($projet->lead) {
                    $rapport .= "  👤 Responsable : {$projet->lead->nom_lead} ({$projet->lead->poste_lead}) - {$projet->lead->email_lead}\n";
                }

                //  Parties prenantes
                if ($projet->partiePrenante->isNotEmpty()) {
                    $rapport .= "   Parties prenantes :\n";
                    foreach ($projet->partiePrenante as $partie) {
                        $rapport .= "     - {$partie->pivot->fonction} : {$partie->pivot->nom_partie} ({$partie->entite})";
                        if ($partie->pivot->email_partie) {
                            $rapport .= " - Email : {$partie->pivot->email_partie}";
                        }
                        if ($partie->pivot->contact_partie) {
                            $rapport .= " - Contact : {$partie->pivot->contact_partie}";
                        }
                        $rapport .= "\n";
                    }
                }



                //  Jalons et Activités
                foreach ($projet->jalon as $jalon) {
                    $rapport .= "     Jalon : {$jalon->nom_jalon}\n";
                    $rapport .= "       - Taux d'avancement : {$jalon->taux_avancement}%\n";
                    $rapport .= "       - Début : {$jalon->date_debut}\n";
                    $rapport .= "       - Fin prévue : {$jalon->date_prevue}\n";
                    $rapport .= "       - Fin réelle : " . ($jalon->date_fin ?? 'Non renseignée') . "\n";
                    $rapport .= "       - Statut : {$jalon->statut_jalon}\n";

                    foreach ($jalon->activite as $activite) {
                        $rapport .= "        Activité : {$activite->nom_activite}\n";
                        $rapport .= "          - Début : {$activite->date_debut}\n";
                        $rapport .= "          - Fin prévue : {$activite->date_prevue}\n";
                        $rapport .= "          - Fin réelle : " . ($activite->date_fin ?? 'Non renseignée') . "\n";
                        $rapport .= "          - Statut : {$activite->statut_activite}\n";

                        // Détails de réunion s'il y en a
                        if ($activite->lieu_reunion || $activite->heure_reunion || $activite->description_reunion) {
                            $rapport .= "          - Activité :\n";
                            if ($activite->lieu_reunion) {
                                $rapport .= "              • NB : {$activite->lieu_reunion}\n";
                            }
                            if ($activite->heure_reunion) {
                                $rapport .= "              • Heure : {$activite->heure_reunion}\n";
                            }
                            if ($activite->description_reunion) {
                                $rapport .= "              • Description : {$activite->description_reunion}\n";
                            }
                        }
                    }
                }
            }

            $rapport .= "\n\n";
        }

        return response()->json([
            'message' => 'Données enrichies collectées avec succès',
            'rapport' => $rapport,
        ]);
    }
}
