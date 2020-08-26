<?php

namespace App\Notifications;

use App\Username;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UsernameFound extends Notification implements ShouldQueue
{
    use Queueable;
    /**
     * @var
     */
    private $username;

    /**
     * Create a new notification instance.
     *
     * @param Username $username
     */
    public function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->success()
            ->subject('Twitch username now available!')
            ->markdown('mail.usernames.found', [
                'twitchUrl' => 'https://www.twitch.tv/settings/profile',
                'username'  => $this->username,
                'searchUrl' => route('search'),
            ]);
    }
}
