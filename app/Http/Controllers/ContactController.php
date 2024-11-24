<?php

namespace App\Http\Controllers;

use App\Helpers\NotifiableHelpers;
use Exception;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Notifications\ContactNotification;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Stockage des données dans la base de données
        $contact = Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
        ]);

        $status = 'Votre message a été envoyé avec succès!';
        try {
            // Envoi de la notification par mail
            NotifiableHelpers::SystemNotifiable()->notify(
                new ContactNotification($contact)
            );
        } catch (Exception $ex) {
            // En cas d'erreur d'envoi
            $status = 'Une erreur est survenue lors de l\'envoi du mail. Veuillez réessayer plus tard.';
            // Optionnel : Log de l'exception
            Log::error('Erreur d\'envoi de notification de contact: ' . $ex->getMessage());
        }

        // Envoi de la notification par mail

        // Retour avec un message de succès
        return back()->with('conatactMailStatus', $status);
    }
}
