<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\_UsersModel;

class UserRegisterMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(_UsersModel $user)
    {
        $this->user = $user; //bu gelen değer view'e otomatik olarak gönderilir.

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject(config('app.name'. ' - User Register'))
        ->view('layouts.emails.user_register');
    }
}
