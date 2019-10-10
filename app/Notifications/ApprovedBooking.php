<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ApprovedBooking extends Notification
{
    use Queueable;

    /**
     * Create a new notaification instance.
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
        ->subject('Approved for booking')
        ->greeting('Good day,')
        ->line('Travel Request has been approved!')
        ->line('Traveler Name: '.$this->users_request->traveler_name)
        ->line('Destination : '.$this->new_destination)
        ->line('Baggage Allowance : '.$this->users_request->baggage_allowance)
        ->line('Budget Code : '.$this->users_request->budget_code_line)
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
