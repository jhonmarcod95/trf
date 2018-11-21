<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EditRequestNotif extends Notification
{
    use Queueable;
    
    /**
    * Create a new notification instance.
    *
    * @return void
    */
    protected $users_request;
    protected $new_destination;
    public function __construct($users_request,$new_destination)
    {
        //
        $this->users_request = $users_request;
        $this->new_destination =$new_destination;
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
        ->subject('Update Request!')
        ->greeting('Good day,')
        ->line('Your request has been succesfully Updated.')
        ->line('Traveler Name: '.$this->users_request->traveler_name)
        ->line('Destination : '.$this->new_destination)
        ->action('Submitted Request', url('/pending-request'))
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
