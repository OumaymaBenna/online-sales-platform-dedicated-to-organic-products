<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Afficher le formulaire de contact
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Traiter l'envoi du formulaire de contact
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'sujet' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'telephone' => 'nullable|string|max:20',
            'type_contact' => 'required|in:general,produit,technique,partenariat,autre',
        ]);

        try {
            // Log du message de contact
            Log::info('Nouveau message de contact reçu', [
                'nom' => $request->nom,
                'email' => $request->email,
                'sujet' => $request->sujet,
                'type' => $request->type_contact,
                'date' => now(),
            ]);

            // Ici vous pourriez envoyer un email à l'administrateur
            // Mail::to('contact@marchelocal.tn')->send(new ContactMessage($request->all()));

            return redirect()->back()->with('success', 'Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.');

        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi du message de contact: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'envoi de votre message. Veuillez réessayer.');
        }
    }
} 