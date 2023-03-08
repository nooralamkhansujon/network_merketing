<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTransactionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $affiliateUserId;
    public $commission;
    public $percentage;
    public $user ;

    public function __construct($affiliateUserId,$commission,$percentage,$user)
    {
        $this->affiliateUserId = $affiliateUserId;
        $this->commission = $commission;
        $this->percentage = $percentage;
        $this->user    = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'affiliateId' => $this->affiliateUserId,
            'commission' => $this->commission,
            'percentage' => $this->percentage,
            'user_id'    => $this->user->id,
            'message' =>  "you get {$this->commission} amount as Commission from {$this->user->name}"
        ];
    }
}
