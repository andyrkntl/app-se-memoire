<?php

// database/migrations/xxxx_xx_xx_create_formulaires_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulairesTable extends Migration
{
    public function up()
    {
        Schema::create('formulaires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Nom_chantier'); // Clé étrangère vers la table chantiers
            $table->decimal('pourcentage_realisation', 5, 2);
            $table->text('commentaires')->nullable();
            $table->timestamps();

            // Définir la clé étrangère
            $table->foreign('Nom_chantier')->references('id')->on('chantiers')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('formulaires');
    }
}

