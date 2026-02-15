@extends('layouts.base')

@section('title', 'Détails Enseignant')

@section('content')
<div class="container">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('enseignants.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>

    <!-- Enseignant Details Card -->
    <div class="card">
        <div class="card-header bg-success text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="bi bi-person-badge-fill"></i> 
                    {{ $enseignant->prenom }} {{ $enseignant->nom }}
                </h4>
                @if($enseignant->statut === 'actif')
                    <span class="badge bg-light text-success fs-6">
                        <i class="bi bi-check-circle-fill"></i> Actif
                    </span>
                @else
                    <span class="badge bg-light text-danger fs-6">
                        <i class="bi bi-x-circle-fill"></i> Inactif
                    </span>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                    <h5 class="border-bottom pb-2 mb-3">
                        <i class="bi bi-info-circle text-primary"></i> Informations Personnelles
                    </h5>
                    
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">
                                <i class="bi bi-tag-fill text-muted"></i> Matricule:
                            </th>
                            <td>
                                <span class="badge bg-primary">{{ $enseignant->matricule }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-person-fill text-muted"></i> Nom:
                            </th>
                            <td><strong>{{ $enseignant->nom }}</strong></td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-person-fill text-muted"></i> Prénom:
                            </th>
                            <td><strong>{{ $enseignant->prenom }}</strong></td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-envelope-fill text-muted"></i> Email:
                            </th>
                            <td>
                                <a href="mailto:{{ $enseignant->email }}">{{ $enseignant->email }}</a>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-telephone-fill text-muted"></i> Téléphone:
                            </th>
                            <td>
                                @if($enseignant->telephone)
                                    <a href="tel:{{ $enseignant->telephone }}">{{ $enseignant->telephone }}</a>
                                @else
                                    <span class="text-muted">Non renseigné</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <h5 class="border-bottom pb-2 mb-3">
                        <i class="bi bi-briefcase text-primary"></i> Informations Professionnelles
                    </h5>
                    
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">
                                <i class="bi bi-bookmark-fill text-muted"></i> Grade:
                            </th>
                            <td>
                                <span class="badge bg-success">{{ $enseignant->grade }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-building text-muted"></i> Département:
                            </th>
                            <td><strong>{{ $enseignant->departement }}</strong></td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-shield-check text-muted"></i> Statut:
                            </th>
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
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-calendar-plus text-muted"></i> Créé le:
                            </th>
                            <td>{{ $enseignant->created_at->format('d/m/Y à H:i') }}</td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-calendar-check text-muted"></i> Modifié le:
                            </th>
                            <td>{{ $enseignant->updated_at->format('d/m/Y à H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('enseignants.edit', $enseignant->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Modifier
                </a>
                
                @if($enseignant->statut === 'actif')
                    <form action="{{ route('enseignants.destroy', $enseignant->id) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('Êtes-vous sûr de vouloir désactiver cet enseignant ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-slash-circle"></i> Désactiver
                        </button>
                    </form>
                @else
                    <form action="{{ route('enseignants.reactiver', $enseignant->id) }}" 
                          method="POST" 
                          class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-arrow-clockwise"></i> Réactiver
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection