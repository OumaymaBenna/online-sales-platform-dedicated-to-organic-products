<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            // Validation des données
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'user_type' => 'required|in:client,producteur',
            ]);

            // Création de l'utilisateur
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_type' => $request->user_type,
            ]);

            // Déclencher l'événement d'inscription
            event(new Registered($user));

            // Déclencher la mise à jour des statistiques
            session()->flash('stats_updated', true);

            // Message de succès et redirection vers la page de connexion
            return redirect()->route('login')->with('success', 'Inscription réussie ! Vous pouvez maintenant vous connecter avec vos identifiants.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Les erreurs de validation sont automatiquement gérées par Laravel
            throw $e;
        } catch (\Exception $e) {
            // Gestion des autres erreurs
            return redirect()->back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->with('error', 'Une erreur s\'est produite lors de l\'inscription. Veuillez réessayer.');
        }
    }
}