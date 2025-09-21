/**
 * Gestionnaire de statistiques en temps réel pour Marché Local
 */
class StatsManager {
    constructor() {
        this.statsElements = {
            'producteurs': ['producersCount', 'producteursCount'],
            'produits': ['productsCount', 'produitsCount'],
            'clients': ['customersCount', 'clientsCount'],
            'commandes': ['ordersCount', 'commandesCount'],
            'annee_creation': ['anneeCreation']
        };
        this.updateInterval = null;
        this.isAnimating = false;
    }

    /**
     * Initialiser le gestionnaire de statistiques
     */
    init() {
        this.startAutoUpdate();
        this.setupEventListeners();
    }

    /**
     * Démarrer la mise à jour automatique des statistiques
     */
    startAutoUpdate() {
        // Mettre à jour toutes les 30 secondes
        this.updateInterval = setInterval(() => {
            this.updateStats();
        }, 30000);
    }

    /**
     * Configurer les écouteurs d'événements
     */
    setupEventListeners() {
        // Mettre à jour les stats quand une action est effectuée
        document.addEventListener('statsUpdated', (e) => {
            this.updateStats();
        });

        // Mettre à jour les stats après création d'un compte
        document.addEventListener('userRegistered', (e) => {
            setTimeout(() => this.updateStats(), 1000);
        });

        // Mettre à jour les stats après ajout d'un produit
        document.addEventListener('productAdded', (e) => {
            setTimeout(() => this.updateStats(), 1000);
        });

        // Mettre à jour les stats après passage d'une commande
        document.addEventListener('orderPlaced', (e) => {
            setTimeout(() => this.updateStats(), 1000);
        });
    }

    /**
     * Mettre à jour les statistiques depuis le serveur
     */
    async updateStats() {
        try {
            const response = await fetch('/stats');
            const data = await response.json();
            
            if (data.success) {
                this.updateDisplayedStats(data.stats);
            }
        } catch (error) {
            console.error('Erreur lors de la mise à jour des statistiques:', error);
        }
    }

    /**
     * Mettre à jour l'affichage des statistiques
     */
    updateDisplayedStats(stats) {
        Object.keys(stats).forEach(statKey => {
            const elementIds = this.statsElements[statKey];
            if (elementIds) {
                elementIds.forEach(elementId => {
                    const element = document.getElementById(elementId);
                    if (element) {
                        const currentValue = parseInt(element.textContent) || 0;
                        const newValue = stats[statKey];
                        
                        if (currentValue !== newValue) {
                            this.animateCounter(element, currentValue, newValue);
                        }
                    }
                });
            }
        });
    }

    /**
     * Animer un compteur de valeur actuelle vers nouvelle valeur
     */
    animateCounter(element, from, to) {
        if (this.isAnimating) return;
        
        this.isAnimating = true;
        const duration = 1000; // 1 seconde
        const steps = 30;
        const increment = (to - from) / steps;
        let current = from;
        let step = 0;

        const timer = setInterval(() => {
            step++;
            current += increment;
            
            if (step >= steps) {
                current = to;
                clearInterval(timer);
                this.isAnimating = false;
            }
            
            element.textContent = Math.round(current);
        }, duration / steps);
    }

    /**
     * Forcer la mise à jour des statistiques
     */
    forceUpdate() {
        this.updateStats();
    }

    /**
     * Arrêter la mise à jour automatique
     */
    stop() {
        if (this.updateInterval) {
            clearInterval(this.updateInterval);
            this.updateInterval = null;
        }
    }
}

// Initialiser le gestionnaire quand le DOM est prêt
document.addEventListener('DOMContentLoaded', function() {
    window.statsManager = new StatsManager();
    window.statsManager.init();
});

// Fonctions utilitaires globales
window.updateStats = function() {
    if (window.statsManager) {
        window.statsManager.forceUpdate();
    }
};

window.triggerStatsUpdate = function(eventName) {
    document.dispatchEvent(new CustomEvent(eventName));
}; 