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
        Schema::create('works', function (Blueprint $table) {
            $table->id('work_id');
            $table->string('work_title')->nullable();
            $table->string('work')->nullable();
            $table->string('work_link')->nullable();
            $table->string('work_abstract')->nullable();
            $table->string('work_proposal')->nullable();
            $table->string('work_ppt')->nullable();
            $table->string('work_original')->nullable();
            $table->foreignId('team_id')
                ->constrained('teams', 'team_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
