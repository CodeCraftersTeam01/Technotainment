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
        Schema::create('media_partners', function (Blueprint $table) {
            $table->id('media_partner_id');
            $table->string('media_partner_name');
            $table->string('media_partner_logo');
            $table->foreignId('event_id')
                ->constrained('events', 'event_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_partners');
    }
};
