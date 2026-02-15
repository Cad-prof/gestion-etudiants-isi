<?php

namespace App\Http\Controllers;

use App\Models\EtudiantISI;
use App\Models\Enseignant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques des étudiants
        $totalEtudiants = EtudiantISI::count();
        $etudiantsActifs = EtudiantISI::where('statut', true)->count();
        $etudiantsInactifs = EtudiantISI::where('statut', false)->count();

        // Statistiques des enseignants
        $totalEnseignants = Enseignant::count();
        $enseignantsActifs = Enseignant::actifs()->count();
        $enseignantsInactifs = Enseignant::inactifs()->count();

        // Enseignants par département
        $enseignantsParDepartement = Enseignant::actifs()
            ->selectRaw('departement, count(*) as total')
            ->groupBy('departement')
            ->orderBy('total', 'desc')
            ->get();

        // Derniers étudiants ajoutés
        $derniersEtudiants = EtudiantISI::latest()->take(5)->get();

        // Derniers enseignants ajoutés
        $derniersEnseignants = Enseignant::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalEtudiants',
            'etudiantsActifs',
            'etudiantsInactifs',
            'totalEnseignants',
            'enseignantsActifs',
            'enseignantsInactifs',
            'enseignantsParDepartement',
            'derniersEtudiants',
            'derniersEnseignants'
        ));
    }
}