<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion Étudiants ISI')</title>
    
    <!-- Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('etudiants.index') }}">Gestion ISI</a>
                <div class="navbar-nav">
                    <a class="nav-link" href="{{ route('etudiants.index') }}">Liste</a>
                    <a class="nav-link" href="{{ route('etudiants.create') }}">Ajouter</a>
                </div>
            </div>
        </nav>

        
        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
