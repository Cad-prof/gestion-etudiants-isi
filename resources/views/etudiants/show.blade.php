@extends('layouts.base')

@section('title', 'Détails Étudiant')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2>Détails de l'Étudiant</h2>
        <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">← Retour</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th width="200">Matricule</th>
                <td>{{ $etudiant->matricule }}</td>
            </tr>
            <tr>
                <th>Nom</th>
                <td>{{ $etudiant->nom }}</td>
            </tr>
            <tr>
                <th>Prénom</th>
                <td>{{ $etudiant->prenom }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $etudiant->email }}</td>
            </tr>
            <tr>
                <th>Téléphone</th>
                <td>{{ $etudiant->telephone ?? 'Non renseigné' }}</td>
            </tr>
            <tr>
                <th>Date de naissance</th>
                <td>{{ $etudiant->date_naissance->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Statut</th>
                <td>
                    @if($etudiant->statut)
                        <span class="badge bg-success">Actif</span>
                    @else
                        <span class="badge bg-danger">Inactif</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Créé le</th>
                <td>{{ $etudiant->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <th>Modifié le</th>
                <td>{{ $etudiant->updated_at->format('d/m/Y H:i') }}</td>
            </tr>
        </table>

        <div class="mt-3">
            <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-warning">✏️ Modifier</a>
            
            <form action="{{ route('etudiants.destroy', $etudiant->id) }}" 
                  method="POST" 
                  class="d-inline"
                  onsubmit="return confirm('Êtes-vous sûr ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </div>
    </div>
</div>
@endsection
