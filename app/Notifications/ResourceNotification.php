<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Resource;
use Illuminate\Bus\Queueable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResourceNotification extends Notification
{
    use Queueable;

    private User|Authenticatable $author;
    private string $action;
    private Resource $resource;

    /**
     * Create a new notification instance.
     */
    public function __construct(User|Authenticatable $authore, Resource $resource, string $action)
    {
        $this->author = $authore;
        $this->action = $action;
        $this->resource = $resource;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'action' => $this->action,
            'author' => [
                'id' => $this->author->id,
                'name' => $this->author->name
            ],
            'resource' => [
                'id' => $this->resource,
            ],
            'show' => '', // pas encore implementer
        ];
    }
}
