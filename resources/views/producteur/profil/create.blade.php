<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer mon profil producteur</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f8f9fa; margin: 0; padding: 0; }
        .container { max-width: 500px; margin: 3rem auto; background: #fff; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.08); padding: 2rem; }
        h1 { text-align: center; color: #2e7d32; margin-bottom: 2rem; }
        form > div { margin-bottom: 1.2rem; }
        label { display: block; font-weight: 600; margin-bottom: 0.5rem; color: #333; }
        input, textarea { width: 100%; padding: 0.8rem; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 1rem; }
        textarea { min-height: 80px; }
        button { background: #2e7d32; color: #fff; border: none; border-radius: 50px; padding: 0.9rem 2rem; font-weight: 600; font-size: 1.1rem; cursor: pointer; width: 100%; margin-top: 1.5rem; transition: background 0.3s; }
        button:hover { background: #1b5e20; }
        .error { color: #b91c1c; background: #fee2e2; border-left: 4px solid #ef4444; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Créer mon profil producteur</h1>
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('producteur.profil.store') }}">
            @csrf
            <div>
                <label>Nom de l'entreprise</label>
                <input type="text" name="nom_entreprise" required value="{{ old('nom_entreprise') }}">
            </div>
            <div>
                <label>Adresse</label>
                <input type="text" name="adresse" required value="{{ old('adresse') }}">
            </div>
            <div>
                <label>Téléphone</label>
                <input type="text" name="telephone" required value="{{ old('telephone') }}">
            </div>
            <div>
                <label>Description</label>
                <textarea name="description" required>{{ old('description') }}</textarea>
            </div>
            <button type="submit">Créer mon profil producteur</button>
        </form>
    </div>
</body>
</html> 