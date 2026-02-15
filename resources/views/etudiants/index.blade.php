@extends('layouts.base')

@section('title', 'Liste des Étudiants')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2>Liste des Étudiants ISI</h2>
        <a href="{{ route('etudiants.create') }}" class="btn btn-primary">
             Ajouter un étudiant
        </a>
    </div>
    <div class="card-body">
        {{-- Success message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($etudiants->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Matricule</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Date naissance</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($etudiants as $etudiant)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $etudiant->matricule }}</strong></td>
                                <td>{{ $etudiant->nom }}</td>
                                <td>{{ $etudiant->prenom }}</td>
                                <td>{{ $etudiant->email }}</td>
                                <td>{{ $etudiant->telephone ?? 'N/A' }}</td>
                                <td>{{ $etudiant->date_naissance->format('d/m/Y') }}</td>
                                <td>
                                    @if($etudiant->statut)
                                        <span class="badge bg-success">Actif</span>
                                    @else
                                        <span class="badge bg-danger">Inactif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group " role="group">
                                        {{-- View button --}}
                                        <a href="{{ route('etudiants.show', $etudiant->id) }}" 
                                           class="btn btn-sm btn-info"
                                           title="Voir">
                                            Voir
                                        </a>
                                        
                                        {{-- Edit button --}}
                                        <a href="{{ route('etudiants.edit', $etudiant->id) }}" 
                                           class="btn btn-sm btn-warning"
                                           title="Modifier">
                                            Modifier
                                        </a>
                                        
                                        {{-- Delete button --}}
                                        <form action="{{ route('etudiants.destroy', $etudiant->id) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger"
                                                    title="Supprimer">
                                                    Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                Aucun étudiant trouvé. <a href="{{ route('etudiants.create') }}">Ajouter le premier étudiant</a>
            </div>
        @endif
    </div>
</div>
@endsection
