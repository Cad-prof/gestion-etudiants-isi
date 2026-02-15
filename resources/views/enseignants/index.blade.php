@extends('layouts.base')

@section('title', 'Liste des Enseignants')

@section('content')
<div class="container">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 mb-0">
                <i class="bi bi-person-badge text-success"></i> Gestion des Enseignants
            </h1>
            <p class="text-muted">{{ $enseignants->total() }} enseignant(s) trouvé(s)</p>
        </div>
        <a href="{{ route('enseignants.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Nouvel Enseignant
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Search & Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('enseignants.index') }}" method="GET">
                <div class="row g-3">
                    <!-- Search Input -->
                    <div class="col-md-4">
                        <label for="search" class="form-label">
                            <i class="bi bi-search"></i> Rechercher
                        </label>
                        <input type="text" 
                               class="form-control" 
                               id="search" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Matricule, nom, prénom, département...">
                    </div>

                    <!-- Département Filter -->
                    <div class="col-md-3">
                        <label for="departement" class="form-label">
                            <i class="bi bi-building"></i> Département
                        </label>
                        <select class="form-select" id="departement" name="departement">
                            <option value="">Tous les départements</option>
                            @foreach($departements as $dept)
                                <option value="{{ $dept }}" {{ request('departement') == $dept ? 'selected' : '' }}>
                                    {{ $dept }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Statut Filter -->
                    <div class="col-md-3">
                        <label for="statut" class="form-label">
                            <i class="bi bi-funnel"></i> Statut
                        </label>
                        <select class="form-select" id="statut" name="statut">
                            <option value="">Tous les statuts</option>
                            <option value="actif" {{ request('statut') == 'actif' ? 'selected' : '' }}>Actif</option>
                            <option value="inactif" {{ request('statut') == 'inactif' ? 'selected' : '' }}>Inactif</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="col-md-2">
                        <label class="form-label d-block">&nbsp;</label>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Filtrer
                        </button>
                        @if(request()->hasAny(['search', 'departement', 'statut']))
                            <a href="{{ route('enseignants.index') }}" class="btn btn-secondary w-100 mt-2">
                                <i class="bi bi-x-circle"></i> Réinitialiser
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Enseignants Table -->
    @if($enseignants->count() > 0)
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="12%">Matricule</th>
                                <th width="15%">Nom</th>
                                <th width="15%">Prénom</th>
                                <th width="15%">Grade</th>
                                <th width="13%">Département</th>
                                <th width="10%">Statut</th>
                                <th width="15%" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enseignants as $enseignant)
                                <tr>
                                    <td>{{ $loop->iteration + ($enseignants->currentPage() - 1) * $enseignants->perPage() }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $enseignant->matricule }}</span>
                                    </td>
                                    <td><strong>{{ $enseignant->nom }}</strong></td>
                                    <td><strong>{{ $enseignant->prenom }}</strong></td>
                                    <td>
                                        <i class="bi bi-bookmark-fill text-success"></i>
                                        {{ $enseignant->grade }}
                                    </td>
                                    <td>
                                        <i class="bi bi-building text-primary"></i>
                                        {{ $enseignant->departement }}
                                    </td>
                                    <td>
                                        @if($enseignant->statut === 'actif')
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle"></i> Actif
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="bi bi-x-circle"></i> Inactif
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <!-- View -->
                                            <a href="{{ route('enseignants.show', $enseignant->id) }}" 
                                               class="btn btn-info" 
                                               title="Voir">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            
                                            <!-- Edit -->
                                            <a href="{{ route('enseignants.edit', $enseignant->id) }}" 
                                               class="btn btn-warning" 
                                               title="Modifier">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            
                                            @if($enseignant->statut === 'actif')
                                                <!-- Désactiver -->
                                                <form action="{{ route('enseignants.destroy', $enseignant->id) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Désactiver {{ $enseignant->prenom }} {{ $enseignant->nom }} ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-danger" 
                                                            title="Désactiver">
                                                        <i class="bi bi-slash-circle"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <!-- Réactiver -->
                                                <form action="{{ route('enseignants.reactiver', $enseignant->id) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="btn btn-success" 
                                                            title="Réactiver">
                                                        <i class="bi bi-arrow-clockwise"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $enseignants->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox display-1 text-muted"></i>
                <h3 class="mt-3">Aucun enseignant trouvé</h3>
                <p class="text-muted">
                    @if(request()->hasAny(['search', 'departement', 'statut']))
                        Aucun résultat ne correspond à votre recherche.
                    @else
                        Commencez par ajouter votre premier enseignant.
                    @endif
                </p>
                <a href="{{ route('enseignants.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Ajouter un enseignant
                </a>
            </div>
        </div>
    @endif
</div>
@endsection