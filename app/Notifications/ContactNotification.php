<?php

namespace App\Notifications;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ContactNotification extends Notification
{
    use Queueable;

    public $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouveau message de contact')
            ->line('Vous avez reçu un nouveau message.')
            ->line('Nom: ' . $this->contact->name)
            ->line('Email: ' . $this->contact->email)
            ->line('Message: ' . $this->contact->message)
            ->action('Voir les détails', url('/'))
            ->line('Merci de nous avoir contacté!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user' => [
                'name' => $this->contact->name,
                'email' => $this->contact->email,
            ],
            'message' => $this->contact->message
        ];
    }
}
