<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $resetLink;

    public function __construct(string $resetLink)
    {
        $this->resetLink = $resetLink;
    }

    public function build(): self
    {
        return $this->subject('Reset Your PhilTrain Password')
                    ->view('emails.reset_password');
    }
}