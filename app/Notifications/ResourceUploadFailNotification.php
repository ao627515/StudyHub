<?php

namespace App\Notifications;

use Throwable;
use App\Models\Resource;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResourceUploadFailNotification extends Notification
{
    use Queueable;

    private array $data;
    private ?Throwable $exception;

    /**
     * Create a new notification instance.
     */
    public function __construct(array $data, ?Throwable $exception = null)
    {
        $this->data = $data;
        $this->exception = $exception;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $subject = "Échec de l'upload : {$this->data['name']}";
        $errorDetails = $this->exception ? $this->exception->getMessage() : 'Une erreur inconnue s\'est produite.';

        return (new MailMessage)
            ->subject($subject)
            ->greeting('Bonjour,')
            ->line("L'upload de la ressource '{$this->data['name']}' a échoué.")
            ->line('Veuillez vérifier le système et réessayer.')
            ->line('Merci d\'utiliser notre application.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'author' => $notifiable->email,
            'resource' => $this->data,
            'error' => $this->exception ? $this->exception->getMessage() : null,
        ];
    }
}
