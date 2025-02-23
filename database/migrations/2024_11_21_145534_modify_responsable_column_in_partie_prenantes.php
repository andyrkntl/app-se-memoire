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
        Schema::table('partie_prenantes', function (Blueprint $table) {
            // Modifier la colonne Responsable pour qu'elle accepte les valeurs NULL
            $table->string('Responsable')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('partie_prenantes', function (Blueprint $table) {
            //
            // Revenir à l'état initial si nécessaire (non NULL)
            $table->string('Responsable')->nullable(false)->change();
        });
    }
};
