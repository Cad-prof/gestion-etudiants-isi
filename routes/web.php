<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantISIController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('etudiants', EtudiantISIController::class);