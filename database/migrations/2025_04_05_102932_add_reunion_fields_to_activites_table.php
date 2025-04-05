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
        Schema::table('activites', function (Blueprint $table) {
            $table->string('lieu_reunion')->nullable();
            $table->time('heure_reunion')->nullable();
            $table->text('description_reunion')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('activites', function (Blueprint $table) {
            $table->dropColumn(['lieu_reunion', 'heure_reunion', 'description_reunion']);
        });
    }
};
