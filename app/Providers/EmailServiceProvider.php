<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class EmailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

       VerifyEmail::toMailUsing(function ($notifiable, $url) {
    return (new MailMessage)
        ->greeting("Hello {$notifiable->first_name},")
        ->subject('Verify Your Email Address')
        ->line('Thank you for registering with ThousandsLink.')
        ->line('Please confirm your email address by clicking the button below.')
        ->action('Verify Email Address', $url)
        ->line('After verification, your account will be reviewed. Our team will contact you if any additional information is required.')
        ->line('If you did not create this account, you can safely ignore this email.');
});


       ResetPassword::toMailUsing(function ($notifiable, string $token) {

    $url = route('password.reset', [
        'token' => $token,
        'email' => $notifiable->getEmailForPasswordReset()
    ]);

    return (new MailMessage)
        ->greeting("Hello {$notifiable->first_name},")
        ->subject('Reset Your Password')
        ->line('We received a request to reset the password for your ThousandsLink account.')
        ->line('Click the button below to choose a new password.')
        ->action('Reset Password', $url)
        ->line('This link will expire in 60 minutes.')
        ->line('If you did not request a password reset, you can safely ignore this email.');
});

    }
}
