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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('activite_id')->index('evaluations_activite_id_foreign');
            $table->integer('Avancement');
            $table->string('Pro1');
            $table->string('Pro2');
            $table->string('Pro3');
            $table->string('Pro4');
            $table->string('Pro5');
            $table->string('Pro6');
            $table->string('Autres');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
