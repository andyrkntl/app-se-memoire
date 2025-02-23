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
        Schema::create('projets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('lead_id');
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');
            $table->unsignedBigInteger('partiePrenante_id');
            $table->foreign('partiePrenante_id')->references('id')->on('partie_prenantes')->onDelete('cascade');
            $table->unsignedBigInteger('chantier_id');
            $table->foreign('chantier_id')->references('id')->on('chantiers')->onDelete('cascade');
            $table->string('PF');
            $table->string('Nom_projet');
            $table->string('Description_projet');
            $table->string('Objectif');
            $table->string('Duree_projet');
            $table->string('statut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};
