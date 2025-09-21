<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Statistiques - Producteur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Nunito', sans-serif; background: #f5f7fa; color: #333; margin: 0; padding: 0; }
        .dashboard-container { max-width: 1100px; margin: 2rem auto; background: #fff; border-radius: 18px; box-shadow: 0 8px 32px rgba(0,0,0,0.10); padding: 2.5rem; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 2rem; margin-bottom: 2.5rem; }
        .stat-card { background: linear-gradient(135deg, #e8f5e9 60%, #f1f8e9 100%); border-radius: 14px; padding: 1.7rem 1.2rem; box-shadow: 0 2px 12px rgba(46,125,50,0.07); text-align: center; position: relative; }
        .stat-card h2 { font-size: 2.3rem; margin: 0.5rem 0; color: #2e7d32; }
        .stat-card p { color: #666; margin: 0; font-size: 1.05rem; }
        .stat-icon { font-size: 2.5rem; margin-bottom: 0.5rem; color: #4caf50; }
        .stat-explain { font-size: 0.98rem; color: #888; margin-top: 0.7rem; }
        .section-title { text-align: center; margin-bottom: 2.5rem; }
        .charts-section { display: flex; flex-wrap: wrap; gap: 2.5rem; margin-bottom: 2.5rem; }
        .chart-card { flex: 1 1 350px; background: #f9f9f9; border-radius: 14px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 1.5rem; min-width: 320px; }
        .chart-title { font-weight: 600; color: #388e3c; margin-bottom: 1rem; text-align: center; }
        .alert-section { background: #fffbe6; border: 1.5px solid #ffe066; border-radius: 12px; padding: 1.2em 2em; margin-bottom: 2em; box-shadow: 0 2px 8px rgba(255,193,7,0.10); }
        .alert-section h3 { color: #b45309; font-weight: bold; margin-bottom: 0.7em; }
        .alert-list { list-style: none; margin: 0; padding: 0; }
        .alert-list li { margin-bottom: 1em; border-bottom: 1px dashed #ffe066; padding-bottom: 0.7em; }
        .alert-list .prod-nom { font-weight: 600; color: #b45309; }
        .alert-list .prod-qt { color: #7c4700; font-size: 0.98em; }
        .alert-list .prod-date { color: #bfa94a; font-size: 0.9em; }
        .btn-retour { display: inline-block; margin-bottom: 2rem; background: #2e7d32; color: #fff; padding: 0.7rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: background 0.2s; }
        .btn-retour:hover { background: #1b5e20; }
        @media (max-width: 900px) { .charts-section { flex-direction: column; } }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <a href="{{ route('producteur.dashboard') }}" class="btn-retour"><i class="fas fa-arrow-left"></i> Retour à la gestion des produits</a>
        <div class="section-title">
            <h1>Statistiques du Producteur</h1>
            <p>Suivez vos performances et surveillez vos stocks en un coup d'œil</p>
        </div>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-coins"></i></div>
                <h2>{{ number_format($beneficesJour, 2) }} DT</h2>
                <p>Bénéfices du jour</p>
                <div class="stat-explain">Total des ventes réalisées aujourd'hui sur vos produits.</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-calendar-week"></i></div>
                <h2>{{ number_format($beneficesSemaine, 2) }} DT</h2>
                <p>Bénéfices de la semaine</p>
                <div class="stat-explain">Somme des bénéfices générés depuis lundi.</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                <h2>{{ number_format($beneficesAnnee, 2) }} DT</h2>
                <p>Bénéfices de l'année</p>
                <div class="stat-explain">Montant total encaissé depuis le 1er janvier.</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-box"></i></div>
                <h2>{{ $nbProduits }}</h2>
                <p>Produits en catalogue</p>
                <div class="stat-explain">Nombre total de produits que vous proposez actuellement.</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
                <h2>{{ $nbCommandes }}</h2>
                <p>Commandes reçues</p>
                <div class="stat-explain">Nombre de commandes passées sur vos produits.</div>
            </div>
        </div>
        <div class="charts-section">
            <div class="chart-card">
                <div class="chart-title">Évolution des bénéfices (7 derniers jours)</div>
                <canvas id="beneficesChart" height="120"></canvas>
            </div>
            <div class="chart-card">
                <div class="chart-title">Commandes par jour (7 derniers jours)</div>
                <canvas id="commandesChart" height="120"></canvas>
            </div>
        </div>
        @if($produitsAlerte->count())
        <div class="alert-section">
            <h3><i class="fas fa-exclamation-triangle"></i> Produits à réapprovisionner (≤ 10)</h3>
            <ul class="alert-list">
                @foreach($produitsAlerte as $prod)
                <li>
                    <span class="prod-nom">{{ $prod->nom }}</span> <span class="prod-qt">- Quantité restante : <b>{{ $prod->quantite }} {{ $prod->unite }}</b></span>
                    <div class="prod-date"><i class="fas fa-clock"></i> Dernière mise à jour : {{ $prod->updated_at->diffForHumans() }}</div>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <script>
        // Ces données doivent être passées depuis le contrôleur (exemple statique ici)
        const beneficesLabels = {!! json_encode($beneficesLabels ?? ["Lun","Mar","Mer","Jeu","Ven","Sam","Dim"]) !!};
        const beneficesData = {!! json_encode($beneficesData ?? [120, 150, 90, 200, 180, 220, 170]) !!};
        const commandesLabels = beneficesLabels;
        const commandesData = {!! json_encode($commandesData ?? [2, 3, 1, 4, 2, 5, 3]) !!};

        // Courbe des bénéfices
        new Chart(document.getElementById('beneficesChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: beneficesLabels,
                datasets: [{
                    label: 'Bénéfices (DT)',
                    data: beneficesData,
                    borderColor: '#388e3c',
                    backgroundColor: 'rgba(56,142,60,0.08)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#388e3c',
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });
        // Courbe des commandes
        new Chart(document.getElementById('commandesChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: commandesLabels,
                datasets: [{
                    label: 'Commandes',
                    data: commandesData,
                    borderColor: '#ff9800',
                    backgroundColor: 'rgba(255,152,0,0.08)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#ff9800',
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>
</body>
</html> 