<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ForApprovalNotif extends Notification
{
    use Queueable;
    
    /**
    * Create a new notification instance.
    *
    * @return void
    */
    protected $data;
    protected $new_destination;
    public function __construct($data,$new_destination)
    {
        //
        $this->data = $data;
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
        ->subject('For Approval Notification')
        ->greeting('Good day,')
        ->line('Request for Approval.')
        ->line('Traveler Name: '.$this->data->traveler_name)
        ->line('Destination : '.$this->new_destination)
        ->line('Please click the button provided for faster transaction')
        ->action('Pending For Approval', url('/for-approval'))
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
