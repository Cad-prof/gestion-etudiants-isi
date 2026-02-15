<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantISIController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\DashboardController;

// Dashboard (Page d'accueil)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Routes pour les étudiants
Route::resource('etudiants', EtudiantISIController::class);

// Routes pour les enseignants
Route::resource('enseignants', EnseignantController::class);

// Route spéciale pour réactiver un enseignant
Route::post('enseignants/{enseignant}/reactiver', [EnseignantController::class, 'reactiver'])
     ->name('enseignants.reactiver');