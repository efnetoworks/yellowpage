<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AgentRegistration extends Mailable
{
    use Queueable, SerializesModels;

    public $messages, $name, $email, $accountType;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($messages, $name, $email, $accountType)
    {
        $this->messages = $messages;
        $this->name = $name;
        $this->email = $email;
        $this->accountType = $accountType;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.agents.register')->subject('Click The Link Below To Complete Agent Registration!');
    }
}
