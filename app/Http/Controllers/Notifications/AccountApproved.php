<?php

namespace App\Http\Controllers\Notifications;


use NotificationChannels\Gcm\GcmChannel;
use NotificationChannels\Gcm\GcmMessage;
use Illuminate\Notifications\Notification;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return [GcmChannel::class];
    }

    public function toGcm()
    {
        return GcmMessage::create()
            ->badge(1)
            ->title('Account approved')
            ->message("Your  account was approved!");
    }
}