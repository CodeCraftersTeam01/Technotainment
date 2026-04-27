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
        Schema::create('timelines', function (Blueprint $table) {
            $table->id('timeline_id');
            $table->string('timeline_name');
            $table->string('timeline_description');
            $table->date('timeline_start');
            $table->date('timeline_end')->nullable();
            $table->foreignId('competition_id')
                ->constrained('competitions', 'competition_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timelines');
    }
};
