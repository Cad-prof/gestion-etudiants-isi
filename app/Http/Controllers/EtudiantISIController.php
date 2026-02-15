<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EtudiantISI;


class EtudiantISIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $etudiants = EtudiantISI::latest()->get();
    
        return view('etudiants.index', compact('etudiants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('etudiants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         // VALIDATION
        $validated = $request->validate([
            'matricule' => 'required|string|unique:etudiant_isi,matricule|max:255',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tel' => 'nullable|string|max:20',
            'date_naissance' => 'required|date',
            'statut' => 'nullable|boolean',
        ], [

            'matricule.required' => 'Le matricule est obligatoire.',
            'matricule.unique' => 'Ce matricule existe déjà.',
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être valide.',
            'date_naissance.required' => 'La date de naissance est obligatoire.',
            'date_naissance.date' => 'La date de naissance doit être une date valide.',
        ]);

        // Set default value for statut if not provided
        $validated['statut'] = $request->has('statut') ? true : false;

        EtudiantISI::create($validated);

        return back()->with('success', 'Étudiant enregistré avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(EtudiantISI $etudiant)
    {
        return view('etudiants.show', compact('etudiant'));
    }

    /**
     * Show the form for editing the specified student
     */
    public function edit(EtudiantISI $etudiant)
    {
        return view('etudiants.edit', compact('etudiant'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, EtudiantISI $etudiant)
    {
        $validated = $request->validate([
            'matricule' => 'required|string|unique:etudiant_isi,matricule,' . $etudiant->id . '|max:255',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tel' => 'nullable|string|max:20',
            'date_naissance' => 'required|date',
            'statut' => 'nullable|boolean',
        ]);

        $validated['statut'] = $request->has('statut') ? true : false;

        $etudiant->update($validated);

        return redirect()->route('etudiants.index')
                         ->with('success', 'Étudiant modifié avec succès !');
    }


    /**
     * Update the specified resource in storage.
    */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EtudiantISI $etudiant)
    {
        $etudiant->delete();

        return redirect()->route('etudiants.index')
                     ->with('success', 'Étudiant supprimé avec succès !');
    }

}
