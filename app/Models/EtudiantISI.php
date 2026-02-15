<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class EtudiantISI extends Model
{
    use HasFactory;

    protected $table = 'etudiant_isi';
    //
    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'email',
        'tel',
        'date_naissance',
        'statut',
    ];

    protected $casts = [
        'status' => 'boolean',
        'date_naissance' => 'date',
    ];

}
