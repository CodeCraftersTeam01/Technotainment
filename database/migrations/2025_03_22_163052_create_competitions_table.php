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
        Schema::create('competitions', function (Blueprint $table) {
            $table->id('competition_id');
            $table->enum('competition_type', ['E-Sports', 'Non-E-Sports']);
            $table->string('slug')->unique();
            $table->string('competition_name');
            $table->date('competition_end_date');
            $table->string('competition_logo');
            $table->string('competition_second_logo');
            $table->string('competition_third_logo');
            $table->longText('competition_description');
            $table->longText('competition_information');
            $table->string('competition_instance_level');
            $table->string('competition_guide_book');
            $table->enum('competition_status', ['active', 'nonactive'])->default('nonactive');
            $table->integer('competition_fee');
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
        Schema::dropIfExists('competitions');
    }
};
