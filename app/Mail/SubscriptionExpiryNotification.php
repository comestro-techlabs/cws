<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionExpiryNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $daysLeft;
    public $isExpired;

    public function __construct($user, $daysLeft = null, $isExpired = false)
    {
        $this->user = $user;
        $this->daysLeft = $daysLeft;
        $this->isExpired = $isExpired;
    }

    public function build()
    {
        $subject = $this->isExpired 
            ? 'Your Subscription Has Expired' 
            : "Your Subscription Expires in {$this->daysLeft} Days";

        return $this->subject($subject)
                   ->view('emails.subscription-expiry');
    }
}
