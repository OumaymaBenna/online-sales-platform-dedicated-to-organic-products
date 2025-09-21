<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Avis;
use App\Models\Produit;

class NouveauCommentaireProduit extends Notification implements ShouldQueue
{
    use Queueable;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'client_nom' => $this->data['client_nom'],
            'produit_nom' => $this->data['produit_nom'],
            'commentaire' => $this->data['commentaire'],
            'note' => $this->data['note'],
        ];
    }
}