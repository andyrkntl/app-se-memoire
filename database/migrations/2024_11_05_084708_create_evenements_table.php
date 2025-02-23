<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->string('Objet_evenement');
            $table->dateTime('Debut_evenement');
            $table->dateTime('Fin_evenement');
            $table->string('type'); // Colonne manquante dans votre erreur
            $table->string('Statut_evenement'); // Colonne manquante dans votre erreur
            $table->text('Commentaires_evenement')->nullable();
            $table->timestamps();
        });
    }
};
