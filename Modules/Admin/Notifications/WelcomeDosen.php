<?php

namespace Modules\Admin\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeDosen extends Notification
{
    use Queueable;
    private $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
          $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
      return (new MailMessage)
      ->subject('welcome To Loker MIC')
      ->greeting('Hello '.$this->data['name'])
      ->line('Berikut Adalah Informasi Login Anda Sebagai Dosen MIC.')
      ->line('Email : '.$this->data['email'])
      ->line('Password : '.$this->data['password'])
      ->line('Ingat Dan Simpan Email .')
      ->action('Anda Dapat Login', url('/dosen/login'))
      ->line('Terimkasih Telah memilih MIC Sebagai Kampus Anda!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
