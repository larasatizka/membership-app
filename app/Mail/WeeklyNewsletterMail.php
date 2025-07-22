<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WeeklyNewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $articles;

    public function __construct($user, $articles)
    {
        $this->user = $user;
        $this->articles = $articles;
    }

    public function build()
    {
        return $this->subject('Newsletter Harian: Artikel Terbaru')
                    ->view('emails.weekly_newsletter');
    }
}
