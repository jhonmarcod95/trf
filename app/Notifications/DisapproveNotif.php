<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DisapproveNotif extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $users_request;
    protected $new_destination;
    protected $remarks;
    public function __construct($users_request,$new_destination,$remarks)
    {
        //
        $this->users_request = $users_request;
        $this->new_destination =$new_destination;
        $this->remarks =$remarks;
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
        ->subject('Disapproved Notification')
        ->greeting('Good day,')
        ->line('Your Travel Request has been CANCELLED ')
        ->line('Traveler Name: '.$this->users_request->traveler_name)
        ->line('Destination : '.$this->new_destination)
        ->line('Remarks : '.$this->remarks)
        ->action('Cancelled Request', url('/cancelled-request'))
        ->line('Thank you for using our application!');
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
