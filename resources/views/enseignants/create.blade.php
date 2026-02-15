@extends('layouts.base')

@section('title', 'Ajouter un Enseignant')

@section('content')
<div class="container">
    <!-- Page Header -->
    <div class="mb-4">
        <h1 class="h2">
            <i class=" text-success"></i> Nouvel Enseignant
        </h1>
        <p class="text-muted">Remplissez le formulaire pour ajouter un nouvel enseignant</p>
    </div>

    <!-- Error Messages -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <h5 class="alert-heading">
                <i class="bi bi-exclamation-triangle-fill"></i> Erreurs de validation
            </h5>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Form Card -->
    <div class="card">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">
                <i class=""></i> Informations de l'Enseignant
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('enseignants.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <!-- Matricule -->
                    <div class="col-md-6">
                        <label for="matricule" class="form-label">
                            <i class=" text-primary"></i> Matricule
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('matricule') is-invalid @enderror" 
                               id="matricule" 
                               name="matricule" 
                               value="{{ old('matricule') }}"
                               placeholder="Ex: ENS2024001">
                        @error('matricule')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label for="email" class="form-label">
                            <i class=" text-primary"></i> Email
                            <span class="text-danger">*</span>
                        </label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               placeholder="enseignant@universite.edu">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nom -->
                    <div class="col-md-6">
                        <label for="nom" class="form-label">
                            <i class=" text-primary"></i> Nom
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('nom') is-invalid @enderror" 
                               id="nom" 
                               name="nom" 
                               value="{{ old('nom') }}"
                               placeholder="Nom de famille">
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Prénom -->
                    <div class="col-md-6">
                        <label for="prenom" class="form-label">
                            <i class=" text-primary"></i> Prénom
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('prenom') is-invalid @enderror" 
                               id="prenom" 
                               name="prenom" 
                               value="{{ old('prenom') }}"
                               placeholder="Prénom">
                        @error('prenom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Téléphone -->
                    <div class="col-md-6">
                        <label for="telephone" class="form-label">
                            <i class=" text-primary"></i> Téléphone
                            <span class="text-muted">(optionnel)</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('telephone') is-invalid @enderror" 
                               id="telephone" 
                               name="telephone" 
                               value="{{ old('telephone') }}"
                               placeholder="+221 77 123 45 67">
                        @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Grade -->
                    <div class="col-md-6">
                        <label for="grade" class="form-label">
                            <i class=" text-primary"></i> Grade
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('grade') is-invalid @enderror" 
                                id="grade" 
                                name="grade">
                            <option value="">Sélectionnez un grade</option>
                            <option value="Professeur" {{ old('grade') == 'Professeur' ? 'selected' : '' }}>
                                Professeur
                            </option>
                            <option value="Maître de Conférences" {{ old('grade') == 'Maître de Conférences' ? 'selected' : '' }}>
                                Maître de Conférences
                            </option>
                            <option value="Assistant" {{ old('grade') == 'Assistant' ? 'selected' : '' }}>
                                Assistant
                            </option>
                            <option value="Vacataire" {{ old('grade') == 'Vacataire' ? 'selected' : '' }}>
                                Vacataire
                            </option>
                            <option value="Chercheur" {{ old('grade') == 'Chercheur' ? 'selected' : '' }}>
                                Chercheur
                            </option>
                        </select>
                        @error('grade')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Département -->
                    <div class="col-md-6">
                        <label for="departement" class="form-label">
                            <i class=" text-primary"></i> Département
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('departement') is-invalid @enderror" 
                                id="departement" 
                                name="departement">
                            <option value="">Sélectionnez un département</option>
                            <option value="Informatique" {{ old('departement') == 'Informatique' ? 'selected' : '' }}>
                                Informatique
                            </option>
                            <option value="Mathématiques" {{ old('departement') == 'Mathématiques' ? 'selected' : '' }}>
                                Mathématiques
                            </option>
                            <option value="Physique" {{ old('departement') == 'Physique' ? 'selected' : '' }}>
                                Physique
                            </option>
                            <option value="Chimie" {{ old('departement') == 'Chimie' ? 'selected' : '' }}>
                                Chimie
                            </option>
                            <option value="Biologie" {{ old('departement') == 'Biologie' ? 'selected' : '' }}>
                                Biologie
                            </option>
                            <option value="Génie Civil" {{ old('departement') == 'Génie Civil' ? 'selected' : '' }}>
                                Génie Civil
                            </option>
                            <option value="Génie Électrique" {{ old('departement') == 'Génie Électrique' ? 'selected' : '' }}>
                                Génie Électrique
                            </option>
                        </select>
                        @error('departement')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Statut -->
                    <div class="col-md-6">
                        <label for="statut" class="form-label">
                            <i class=" text-primary"></i> Statut
                        </label>
                        <select class="form-select @error('statut') is-invalid @enderror" 
                                id="statut" 
                                name="statut">
                            <option value="actif" {{ old('statut', 'actif') == 'actif' ? 'selected' : '' }}>
                                Actif
                            </option>
                            <option value="inactif" {{ old('statut') == 'inactif' ? 'selected' : '' }}>
                                Inactif
                            </option>
                        </select>
                        @error('statut')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Par défaut: Actif</small>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="d-flex justify-content-end gap-2 mt-4 pt-4 border-top">
                    <a href="{{ route('enseignants.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Annuler
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class=""></i> Enregistrer l'enseignant
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection