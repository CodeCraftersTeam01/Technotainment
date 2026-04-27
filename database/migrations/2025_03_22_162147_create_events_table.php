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
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            $table->string('event_name');
            $table->string('event_logo');
            $table->string('event_theme');
            $table->longText('event_about');
            $table->longText('event_description');
            $table->string('event_year');
            $table->enum('event_status', ['active', 'nonactive'])->default('nonactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
