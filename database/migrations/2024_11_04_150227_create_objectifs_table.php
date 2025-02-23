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
        Schema::create('objectifs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Nom_objectif');
            $table->string('Statut_objectif');
            $table->date('Debut_objectif');
            $table->date('Fin_objectif');
            $table->string('Description_objectif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_objectifs');
    }
};
