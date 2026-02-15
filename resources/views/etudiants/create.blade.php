@extends('layouts.base')

@section('title', 'Ajouter un Étudiant')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Ajouter un Étudiant ISI</h2>
    </div>
    <div class="card-body">
        {{-- Display success message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Display validation errors --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('etudiants.store') }}" method="POST">
            @csrf
            
            <div class="row">
                {{-- Matricule --}}
                <div class="col-md-6 mb-3">
                    <label for="matricule" class="form-label">Matricule <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('matricule') is-invalid @enderror" 
                           id="matricule" 
                           name="matricule" 
                           value="{{ old('matricule') }}"
                           placeholder="Ex: ISI2024001">
                    @error('matricule')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}"
                           placeholder="etudiant@example.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                {{-- Nom --}}
                <div class="col-md-6 mb-3">
                    <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('nom') is-invalid @enderror" 
                           id="nom" 
                           name="nom" 
                           value="{{ old('nom') }}">
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Prenom --}}
                <div class="col-md-6 mb-3">
                    <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('prenom') is-invalid @enderror" 
                           id="prenom" 
                           name="prenom" 
                           value="{{ old('prenom') }}">
                    @error('prenom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                {{-- Telephone --}}
                <div class="col-md-6 mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="text" 
                           class="form-control @error('telephone') is-invalid @enderror" 
                           id="telephone" 
                           name="telephone" 
                           value="{{ old('telephone') }}"
                           placeholder="Optionnel">
                    @error('telephone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Date de naissance --}}
                <div class="col-md-6 mb-3">
                    <label for="date_naissance" class="form-label">Date de naissance <span class="text-danger">*</span></label>
                    <input type="date" 
                           class="form-control @error('date_naissance') is-invalid @enderror" 
                           id="date_naissance" 
                           name="date_naissance" 
                           value="{{ old('date_naissance') }}">
                    @error('date_naissance')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Statut (checkbox) --}}
            <div class="mb-3 form-check">
                <input type="checkbox" 
                       class="form-check-input" 
                       id="statut" 
                       name="statut" 
                       value="1"
                       {{ old('statut', true) ? 'checked' : '' }}>
                <label class="form-check-label" for="statut">
                    Actif (coché par défaut)
                </label>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Enregistrer
                </button>
                <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
 