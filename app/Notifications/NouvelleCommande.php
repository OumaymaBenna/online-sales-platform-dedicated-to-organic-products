<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Commande;

class NouvelleCommande extends Notification
{
    use Queueable;

    protected $commande;
    protected $producteurId;

    /**
     * Create a new notification instance.
     */
    public function __construct(Commande $commande, $producteurId)
    {
        $this->commande = $commande;
        $this->producteurId = $producteurId;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $produits = $this->commande->produits()
            ->where('producteur_id', $this->producteurId)
            ->with('produit')
            ->get();

        $totalProducteur = $produits->sum('prix_total');

        return (new MailMessage)
            ->subject('Nouvelle commande reçue - ' . $this->commande->numero_commande)
            ->line('Vous avez reçu une nouvelle commande !')
            ->line('Numéro de commande : ' . $this->commande->numero_commande)
            ->line('Client : ' . $this->commande->user->name)
            ->line('Total de vos produits : ' . number_format($totalProducteur, 2) . ' DT')
            ->line('Date de commande : ' . $this->commande->date_commande->format('d/m/Y H:i'))
            ->action('Voir la commande', route('producteur.commandes.show', $this->commande->id))
            ->line('Merci de traiter cette commande rapidement !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $produits = $this->commande->produits()
            ->where('producteur_id', $this->producteurId)
            ->with('produit')
            ->get();

        $totalProducteur = $produits->sum('prix_total');

        // Créer un message détaillé avec les produits
        $produitsDetails = [];
        foreach ($produits as $commandeProduit) {
            $produitsDetails[] = $commandeProduit->quantite . ' ' . $commandeProduit->produit->unite . ' de ' . $commandeProduit->produit->nom;
        }
        
        // Message plus joli et professionnel
        if (count($produitsDetails) === 1) {
            $message = '🎉 ' . $this->commande->user->name . ' vient de commander ' . $produitsDetails[0];
        } else {
            $lastProduct = array_pop($produitsDetails);
            $message = '🎉 ' . $this->commande->user->name . ' vient de commander ' . implode(', ', $produitsDetails) . ' et ' . $lastProduct;
        }
        
        $message .= ' - Total : ' . number_format($totalProducteur, 2) . ' DT';

        return [
            'type' => 'nouvelle_commande',
            'commande_id' => $this->commande->id,
            'numero_commande' => $this->commande->numero_commande,
            'client_nom' => $this->commande->user->name,
            'total_producteur' => $totalProducteur,
            'date_commande' => $this->commande->date_commande,
            'message' => $message,
            'produits_details' => $produitsDetails,
        ];
    }
}
