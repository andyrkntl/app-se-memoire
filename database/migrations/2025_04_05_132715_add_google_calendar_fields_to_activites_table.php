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
            $table->string('google_calendar_id')->nullable()->unique()->comment('ID Google Calendar');
            $table->text('google_calendar_link')->nullable()->comment('Lien public Google Calendar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activites', function (Blueprint $table) {
            $table->dropColumn(['google_calendar_id', 'google_calendar_link']);
        });
    }
};
