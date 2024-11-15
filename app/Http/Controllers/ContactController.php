<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
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

        // Envoi de la notification par mail
        Notification::route('mail', env('MAIL_FROM_ADDRESS'))->notify(new ContactNotification($contact));

        // Retour avec un message de succès
        return back()->with('success', 'Votre message a été envoyé avec succès!');
    }
}
