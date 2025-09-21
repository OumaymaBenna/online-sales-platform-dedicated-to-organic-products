<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement réussi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md text-center">
        <h1 class="text-2xl font-bold mb-6 text-green-700">Merci pour votre paiement !</h1>
        <p class="mb-4">Votre commande a bien été enregistrée.</p>
        @if(isset($commande))
            <div class="bg-green-50 p-4 rounded-lg mb-4">
                <p class="font-semibold">Numéro de commande : {{ $commande->numero_commande }}</p>
                <p>Total payé : {{ number_format($commande->total, 2) }} DT</p>
                <p>Date : {{ $commande->date_commande->format('d/m/Y H:i') }}</p>
            </div>
        @endif
        <a href="{{ route('client.dashboard') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">Retour à l'accueil</a>
    </div>
</body>
</html> 