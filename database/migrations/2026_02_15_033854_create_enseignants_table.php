<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enseignants', function (Blueprint $table) {
            $table->id();
            
            // Champs obligatoires
            $table->string('matricule')->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->string('grade');
            $table->string('departement');
            
            // Champs optionnels
            $table->string('telephone')->nullable();
            
            // Statut avec valeur par défaut
            $table->string('statut')->default('actif');
            
            // Timestamps automatiques
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enseignants');
    }
};