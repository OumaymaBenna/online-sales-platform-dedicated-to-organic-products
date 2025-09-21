<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement annulé</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-yellow-50 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md text-center">
        <h1 class="text-2xl font-bold mb-6 text-yellow-700">Paiement annulé</h1>
        <p class="mb-4">Votre paiement a été annulé. Vous pouvez réessayer.</p>
        <a href="{{ route('client.paiement') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">Réessayer le paiement</a>
    </div>
</body>
</html> 