@extends('layouts.base')

@section('title', 'Dashboard - Gestion Universitaire')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 mb-0">
                <i class="bi text-primary"></i> Dashboard
            </h1>
            <p class="text-muted">Vue d'ensemble du système</p>
        </div>
        <div>
            {{-- <span class="badge bg-secondary">{{ now()->format('d/m/Y H:i') }}</span> --}}
        </div>
    </div>

    <!-- Statistics Cards -->
    {{-- <div class="row g-4 mb-4">
        <!-- Étudiants Stats -->
        <div class="col-md-6 col-lg-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 opacity-75">Total Étudiants</h6>
                        <h2 class="mb-0">{{ $totalEtudiants }}</h2>
                    </div>
                    <div class="fs-1 opacity-50">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-top border-white border-opacity-25">
                    <small>
                        <i class="bi bi-check-circle"></i> {{ $etudiantsActifs }} actifs
                        <span class="mx-2">•</span>
                        <i class="bi bi-x-circle"></i> {{ $etudiantsInactifs }} inactifs
                    </small>
                </div>
            </div>
        </div>

        <!-- Enseignants Stats -->
        <div class="col-md-6 col-lg-3">
            <div class="stat-card success">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 opacity-75">Total Enseignants</h6>
                        <h2 class="mb-0">{{ $totalEnseignants }}</h2>
                    </div>
                    <div class="fs-1 opacity-50">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-top border-white border-opacity-25">
                    <small>
                        <i class="bi bi-check-circle"></i> {{ $enseignantsActifs }} actifs
                        <span class="mx-2">•</span>
                        <i class="bi bi-x-circle"></i> {{ $enseignantsInactifs }} inactifs
                    </small>
                </div>
            </div>
        </div>

        <!-- Départements -->
        <div class="col-md-6 col-lg-3">
            <div class="stat-card info">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 opacity-75">Départements</h6>
                        <h2 class="mb-0">{{ $enseignantsParDepartement->count() }}</h2>
                    </div>
                    <div class="fs-1 opacity-50">
                        <i class="bi bi-building"></i>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-top border-white border-opacity-25">
                    <small>
                        <i class="bi bi-graph-up"></i> Répartition active
                    </small>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-md-6 col-lg-3">
            <div class="stat-card warning">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 opacity-75">Actions Rapides</h6>
                        <h2 class="mb-0"><i class="bi bi-lightning-charge"></i></h2>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-top border-white border-opacity-25">
                    <div class="d-grid gap-2">
                        <a href="{{ route('etudiants.create') }}" class="btn btn-light btn-sm">
                            + Étudiant
                        </a>
                        <a href="{{ route('enseignants.create') }}" class="btn btn-light btn-sm">
                            + Enseignant
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Enseignants par Département -->
    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="bi  text-primary"></i>
                        Enseignants par Département
                    </h5>
                </div>
                <div class="card-body">
                    @if($enseignantsParDepartement->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Département</th>
                                        <th class="text-end">Nombre</th>
                                        <th width="40%">Répartition</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($enseignantsParDepartement as $dept)
                                        <tr>
                                            <td>
                                                <strong>{{ $dept->departement }}</strong>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge bg-primary">{{ $dept->total }}</span>
                                            </td>
                                            <td>
                                                <div class="progress" style="height: 25px;">
                                                    <div class="progress-bar" 
                                                         role="progressbar" 
                                                         style="width: {{ ($dept->total / $totalEnseignants) * 100 }}%">
                                                        {{ number_format(($dept->total / $totalEnseignants) * 100, 1) }}%
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-1"></i>
                            <p class="mt-2">Aucun département enregistré</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Derniers Ajouts -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="bi text-primary"></i>
                        Derniers Ajouts
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs mb-3" id="recentTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" 
                                    id="etudiants-tab" 
                                    data-bs-toggle="tab" 
                                    data-bs-target="#etudiants" 
                                    type="button">
                                Étudiants
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" 
                                    id="enseignants-tab" 
                                    data-bs-toggle="tab" 
                                    data-bs-target="#enseignants" 
                                    type="button">
                                Enseignants
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="recentTabContent">
                        <!-- Derniers Étudiants -->
                        <div class="tab-pane fade show active" id="etudiants" role="tabpanel">
                            @if($derniersEtudiants->count() > 0)
                                <ul class="list-group list-group-flush">
                                    @foreach($derniersEtudiants as $etudiant)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $etudiant->prenom }} {{ $etudiant->nom }}</strong>
                                                <br>
                                                <small class="text-muted">
                                                    <i class="bi bi-tag"></i> {{ $etudiant->matricule }}
                                                </small>
                                            </div>
                                            <div class="text-end">
                                                <small class="text-muted d-block">
                                                    {{ $etudiant->created_at->diffForHumans() }}
                                                </small>
                                                @if($etudiant->statut)
                                                    <span class="badge bg-success">Actif</span>
                                                @else
                                                    <span class="badge bg-danger">Inactif</span>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-center text-muted py-3">
                                    <i class="bi bi-inbox"></i>
                                    <p class="mb-0">Aucun étudiant</p>
                                </div>
                            @endif
                        </div>

                        <!-- Derniers Enseignants -->
                        <div class="tab-pane fade" id="enseignants" role="tabpanel">
                            @if($derniersEnseignants->count() > 0)
                                <ul class="list-group list-group-flush">
                                    @foreach($derniersEnseignants as $enseignant)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $enseignant->prenom }} {{ $enseignant->nom }}</strong>
                                                <br>
                                                <small class="text-muted">
                                                    <i class="bi bi-bookmark"></i> {{ $enseignant->grade }}
                                                    <span class="mx-1">•</span>
                                                    <i class="bi bi-building"></i> {{ $enseignant->departement }}
                                                </small>
                                            </div>
                                            <div class="text-end">
                                                <small class="text-muted d-block">
                                                    {{ $enseignant->created_at->diffForHumans() }}
                                                </small>
                                                @if($enseignant->statut === 'actif')
                                                    <span class="badge bg-success">Actif</span>
                                                @else
                                                    <span class="badge bg-danger">Inactif</span>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-center text-muted py-3">
                                    <i class="bi bi-inbox"></i>
                                    <p class="mb-0">Aucun enseignant</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi text-primary fs-1 mb-3"></i>
                    <h5 class="card-title">Gérer les Étudiants</h5>
                    <p class="card-text text-muted">Consulter, ajouter ou modifier les étudiants</p>
                    <a href="{{ route('etudiants.index') }}" class="btn btn-primary">
                        Accéder <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi text-success fs-1 mb-3"></i>
                    <h5 class="card-title">Gérer les Enseignants</h5>
                    <p class="card-text text-muted">Consulter, ajouter ou modifier les enseignants</p>
                    <a href="{{ route('enseignants.index') }}" class="btn btn-success">
                        Accéder <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi text-info fs-1 mb-3"></i>
                    <h5 class="card-title">Recherche Avancée</h5>
                    <p class="card-text text-muted">Rechercher par matricule, nom ou département</p>
                    <a href="{{ route('enseignants.index') }}" class="btn btn-info">
                        Rechercher <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection