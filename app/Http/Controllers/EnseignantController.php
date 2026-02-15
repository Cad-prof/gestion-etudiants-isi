<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use Illuminate\Http\Request;

class EnseignantController extends Controller
{
    /**
     * Liste des enseignants avec recherche
     */
    public function index(Request $request)
    {
        $query = Enseignant::query();

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('matricule', 'like', "%{$search}%")
                  ->orWhere('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('departement', 'like', "%{$search}%");
            });
        }

        // Filtre par statut
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        // Filtre par département
        if ($request->filled('departement')) {
            $query->where('departement', $request->departement);
        }

        $enseignants = $query->latest()->paginate(10);

        // Récupérer la liste des départements pour le filtre
        $departements = Enseignant::select('departement')
                                  ->distinct()
                                  ->orderBy('departement')
                                  ->pluck('departement');

        return view('enseignants.index', compact('enseignants', 'departements'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        return view('enseignants.create');
    }

    /**
     * Enregistrer un nouvel enseignant
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'matricule' => 'required|string|unique:enseignants,matricule|max:255',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'nullable|string|max:20',
            'grade' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'statut' => 'nullable|in:actif,inactif',
        ], [
            'matricule.required' => 'Le matricule est obligatoire.',
            'matricule.unique' => 'Ce matricule existe déjà.',
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être valide.',
            'grade.required' => 'Le grade est obligatoire.',
            'departement.required' => 'Le département est obligatoire.',
        ]);

        // Définir le statut par défaut si non fourni
        $validated['statut'] = $validated['statut'] ?? 'actif';

        Enseignant::create($validated);

        return redirect()->route('enseignants.index')
                        ->with('success', 'Enseignant ajouté avec succès !');
    }

    /**
     * Afficher les détails d'un enseignant
     */
    public function show(Enseignant $enseignant)
    {
        return view('enseignants.show', compact('enseignant'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(Enseignant $enseignant)
    {
        return view('enseignants.edit', compact('enseignant'));
    }

    /**
     * Mettre à jour un enseignant
     */
    public function update(Request $request, Enseignant $enseignant)
    {
        $validated = $request->validate([
            'matricule' => 'required|string|unique:enseignants,matricule,' . $enseignant->id . '|max:255',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'nullable|string|max:20',
            'grade' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'statut' => 'required|in:actif,inactif',
        ]);

        $enseignant->update($validated);

        return redirect()->route('enseignants.index')
                        ->with('success', 'Enseignant modifié avec succès !');
    }

    /**
     * Désactiver un enseignant (suppression logique)
     */
    public function destroy(Enseignant $enseignant)
    {
        $enseignant->desactiver();

        return redirect()->route('enseignants.index')
                        ->with('success', 'Enseignant désactivé avec succès !');
    }

    /**
     * Réactiver un enseignant
     */
    public function reactiver(Enseignant $enseignant)
    {
        $enseignant->reactiver();

        return redirect()->route('enseignants.index')
                        ->with('success', 'Enseignant réactivé avec succès !');
    }
}