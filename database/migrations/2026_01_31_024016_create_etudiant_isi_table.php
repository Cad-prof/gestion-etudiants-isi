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
        Schema::create('etudiant_isi', function (Blueprint $table) {

            $table->id()->umique();
            $table->string('matricule')->umique();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->string('tel')->nullable();
            $table->date('date_naissance');
            $table->boolean('statut')->defult(true)->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('etudiant_isi');
    }
};
