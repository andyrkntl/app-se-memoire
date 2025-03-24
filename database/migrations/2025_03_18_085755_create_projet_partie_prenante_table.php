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
        Schema::create('projet_partie_prenante', function (Blueprint $table) {
            $table->foreignId('projet_id')->constrained()->onDelete('cascade');
            $table->foreignId('partie_prenante_id')->constrained()->onDelete('cascade');
            $table->string('fonction');
            $table->string('nom_partie');
            $table->string('email_partie')->nullable();
            $table->string('contact_partie')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projet_partie_prenante');
    }
};
