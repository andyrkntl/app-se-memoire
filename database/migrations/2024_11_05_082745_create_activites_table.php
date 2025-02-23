<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('projet_id');
            $table->foreign('projet_id')->references('id')->on('projets')->onDelete('cascade');
            $table->unsignedBigInteger('jalon_id');
            $table->foreign('jalon_id')->references('id')->on('jalons')->onDelete('cascade');
            $table->String('Nom_activite');
            $table->String('Description_activite');
            $table->String('Statut_activite');
            $table->String('Valeur_cible');
            $table->String('Valeur_actuel');
            $table->Date('Date_debut');
            $table->Date('Date_fin');
            $table->string('Prochaine_etape');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activites');
    }
};
