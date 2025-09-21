<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement en ligne - MaBoutique</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Paiement en ligne</h1>
        <p class="mb-4 text-center">Montant à payer : <span class="font-bold text-green-700">{{ number_format($total, 2) }} DT</span></p>
        <form action="{{ route('client.paiement.checkout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-300">
                Payer avec carte bancaire
            </button>
        </form>
    </div>
</body>
</html> 