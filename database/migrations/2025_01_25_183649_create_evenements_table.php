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
            $table->string('type');
            $table->string('Statut_evenement');
            $table->text('Commentaires_evenement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(){
        Schema::dropIfExists('evenements');
    }
};
