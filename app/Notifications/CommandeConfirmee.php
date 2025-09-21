<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommandeConfirmee extends Notification
{
    use Queueable;

    public $commande;

    /**
     * Create a new notification instance.
     */
    public function __construct($commande)
    {
        $this->commande = $commande;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database']; // On utilise seulement la base de données pour éviter les erreurs SMTP
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Votre commande #' . $this->commande->numero_commande . ' a été confirmée !')
            ->greeting('Bonjour ' . $notifiable->name . ' !')
            ->line('Nous avons le plaisir de vous informer que votre commande #' . $this->commande->numero_commande . ' a été confirmée par le producteur.')
            ->line('Votre commande est maintenant en cours de préparation et sera expédiée dans les plus brefs délais.')
            ->action('Voir les détails de votre commande', url('/client/commandes'))
            ->line('Merci de votre confiance !')
            ->salutation('Cordialement, l\'équipe MaBoutique');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'commande_confirmee',
            'message' => 'Votre commande #' . $this->commande->numero_commande . ' a été confirmée par le producteur.',
            'commande_id' => $this->commande->id,
            'numero_commande' => $this->commande->numero_commande,
        ];
    }
}
