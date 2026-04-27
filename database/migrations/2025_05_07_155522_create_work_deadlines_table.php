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
        Schema::create('work_deadlines', function (Blueprint $table) {
            $table->id('workdeadline_id');
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('competition_id')->constrained('competitions', 'competition_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_deadlines');
    }
};
