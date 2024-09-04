<?php

namespace App\Notifications;

use App\Models\Reservation;
use FontLib\TrueType\Collection;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationResendNotification extends Notification
{
    use Queueable;

    protected $reservations;

    public function __construct($reservations)
    {
        $this->reservations = $reservations;
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
            ->subject('Resumo das reservas futuras')
                ->view(
                    'emails.reservation_resend',
                    [
                        'reservations' => $this->reservations
                    ]
                );

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
//            'reservation_id' => $this->reservation->id,
//            'reservation_date' => $this->reservation->reservation_date,
        ];
    }
}
