<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        app('config')->set('mail.mailers.smtp.username', env('MAIL_USERNAME_SEND'));
        app('config')->set('mail.mailers.smtp.password', env('MAIL_PASSWORD_SEND'));
        $this->data = $data;
    }


    public function build(): SendEmail
    {
        return $this->subject($this->data['subject'])->view($this->data['template'], $this->data);
    }
}
