<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskAssigned extends Notification
{
    use Queueable;

    public function __construct(public Task $task)
    {
        //
    }

    public function via(object $notifiable): array
    {
        // pour l'instant, uniquement par mail
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nouvelle tâche assignée')
            ->greeting('Bonjour ' . $notifiable->name . ' 👋')
            ->line('Une nouvelle tâche vous a été assignée.')
            ->line('Titre : ' . $this->task->title)
            ->line('Description : ' . ($this->task->description ?: 'Aucune description'))
            ->line('Statut : ' . ($this->task->status?->name ?? 'N/A'))
            ->line('Échéance : ' . ($this->task->due_date ?? 'Aucune'))
            ->action('Voir mes tâches', url('/tasks'))
            ->line('Merci de votre collaboration.');
    }
}
