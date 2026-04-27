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
        Schema::create('member_teams', function (Blueprint $table) {
            $table->id('member_team_id');
            $table->string('member_team_name');
            $table->string('member_team_identity');
            $table->enum('member_team_role', ['Leader', 'Member', 'Backup']);
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
        Schema::dropIfExists('member_teams');
    }
};
