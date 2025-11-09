<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class CustomVerifyEmail extends VerifyEmail
{
    public function toMail($notifiable)
    {
        $verificationUrl = $this->customVerificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verify Your Email Address')
            ->line('Click the button below to verify your email address.')
            ->action('Verify Email', $verificationUrl)
            ->line('If you did not create an account, no further action is required.');
    }

    protected function customVerificationUrl($notifiable)
    {
        $temporarySignedURL = URL::temporarySignedRoute(
            'custom.verification.verify', // <-- This must match your custom route name
            Carbon::now()->addMinutes(60),
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
        );

        return $temporarySignedURL;
    }
}

