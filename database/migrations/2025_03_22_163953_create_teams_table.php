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
        Schema::create('teams', function (Blueprint $table) {
            $table->id('team_id');
            $table->string('team_name');
            $table->string('team_token')->unique();
            $table->string('team_logo')->nullable();
            $table->string('team_email')->unique();
            $table->string('team_contact');
            $table->enum('team_instance', ['YES', 'NO'])->default('NO');
            $table->string('team_instance_name')->nullable();
            $table->enum('team_final_status', ['Penyisihan', 'Semi Final', 'Final', 'Menang', 'Kalah', 'Diskualifikasi'])->default('Penyisihan');
            $table->string('team_invoice')->nullable()->default(null);
            $table->enum('team_invoice_status', ['decline', 'pending', 'accept'])->default('pending');
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
        Schema::dropIfExists('teams');
    }
};
