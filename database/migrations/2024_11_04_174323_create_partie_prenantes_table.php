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
        Schema::create('partie_prenantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Nom_partie');
            $table->string('accronime_partie');
            $table->string('Responsable');
            $table->string('Direction');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_partie_prenantes');
    }
};
