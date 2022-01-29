<?php

namespace App\Notifications;

use Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProviderWelcome extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
		    ->subject('Welcome to ' . config('app.name'))
		    ->greeting('Hello Provider')
                    ->line('Hi There')
                    ->line('Thanks for Joining @venture Cab')
                    ->line('Please email the following documents in order for us to approve your registration')
                    ->line('Copy of owners Drivers ID')
                    ->line('Copy of the Driver\'s ID and drivers licence card')
                    ->line('Copy of the PdP')
                    ->line('Copy of the car registration papers')
                    ->line('Copy of the double disk')
                    ->line('Copy of the permit')
                    ->line('Thanks you and Good Luck')
                    ->line('Regards')
                    ->line('@venture Cab Team');

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
