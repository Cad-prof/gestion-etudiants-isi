<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse
     */
    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'email',
        'telephone',
        'grade',
        'departement',
        'statut',
    ];

    /**
     * Les attributs qui doivent être castés
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope pour récupérer uniquement les enseignants actifs
     */
    public function scopeActifs($query)
    {
        return $query->where('statut', 'actif');
    }

    /**
     * Scope pour récupérer uniquement les enseignants inactifs
     */
    public function scopeInactifs($query)
    {
        return $query->where('statut', 'inactif');
    }

    /**
     * Désactiver l'enseignant (suppression logique)
     */
    public function desactiver()
    {
        $this->statut = 'inactif';
        $this->save();
    }

    /**
     * Réactiver l'enseignant
     */
    public function reactiver()
    {
        $this->statut = 'actif';
        $this->save();
    }

    /**
     * Vérifier si l'enseignant est actif
     */
    public function estActif()
    {
        return $this->statut === 'actif';
    }
}