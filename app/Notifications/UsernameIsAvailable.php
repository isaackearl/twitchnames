<?php

namespace App\Notifications;

use App\Username;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UsernameIsAvailable extends Notification implements ShouldQueue
{
    use Queueable;
    /**
     * @var
     */
    private $username;

    /**
     * Create a new notification instance.
     * @param Username $username
     */
    public function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->success()
            ->subject('Twitch username now available!')
            ->line('The username ' . $this->username->username . ' has recently become available.')
            ->line('Grab it quick before someone else does!')
            ->action('Go to Twitch to claim it now!', 'https://www.twitch.tv/settings/profile')
            ->line('If you would like emails about this username to stop, please remove this username from your saved list.')
            ->line('Thank you for using my application.  If you get the username that you are searching for, please consider donating! https://paypal.me/isaackearl');
    }

}
