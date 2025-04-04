<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPasswordNotification extends Notification
{
    use Queueable;
    protected $token;


    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token =$token;
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
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->from(config('mail.from.address'), 'Learn Syntax') // Explicitly set "from" name
        ->subject('Reset Your Password')
        ->view('emails.password-reset', [
            'token' => $this->token,
            'email' => $notifiable->email, // Pass the user's email for the reset URL
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
