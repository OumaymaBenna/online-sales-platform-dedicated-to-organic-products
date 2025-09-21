<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class StockFaible extends Notification implements ShouldQueue
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
            'type' => 'stock_faible',
            'message' => $this->data['message'],
            'produit_nom' => $this->data['produit_nom'],
            'quantite_restante' => $this->data['quantite_restante'],
            'unite' => $this->data['unite'],
            'seuil_alerte' => $this->data['seuil_alerte'],
        ];
    }
} 