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
        Schema::create('jalons', function (Blueprint $table) {
            $table->integer('id', true);
            $table->foreignId('projet_id')->constrained()->onDelete('cascade');
            $table->string('nom_jalon');
            $table->string('description')->nullable();
            $table->decimal('taux_avancement', 5, 2)->default(0.00);
            $table->date('date_debut');
            $table->date('date_prevue');
            $table->date('date_fin')->nullable();
            $table->enum('statut_jalon', ['En cours', 'Achevé', 'En retard'])->nullable()->default('En cours');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jalons');
    }
};
