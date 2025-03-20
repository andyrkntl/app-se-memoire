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
            $table->integer('id', true);
            $table->foreignId('chantier_id')->constrained()->onDelete('cascade');
            $table->foreignId('lead_id')->constrained()->onDelete('cascade');
            $table->foreignId('partie_prenante_id')->constrained()->onDelete('cascade');
            $table->string('nom_projet');
            $table->text('objectifs');
            $table->text('situation_actuelle');
            $table->text('prochaines_etapes');
            $table->decimal('taux_avancement', 5, 2)->default(0.00);
            $table->date('date_debut');
            $table->date('date_fin');
            $table->enum('statut_projet', ['En cours', 'Achevé', 'En retard'])->nullable()->default('En cours');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
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
