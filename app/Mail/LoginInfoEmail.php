<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginInfoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $password;
    public $name;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email  ,  $password , $name)
    {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('تسجيل حساب للجمعية')->from('platform@hokmny.org', 'حوكمني')->view('emails.login_info');
    }
}
