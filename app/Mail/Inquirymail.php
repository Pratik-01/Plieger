<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Inquirymail extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sender)
    {
        $this->sender = $sender;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $sender = $this->sender;
        return $this->from($sender['email'])->subject('Enquiry To Everest Rhino Travel')->view('emails.inquirymail')->with([
            'sender_name' => $sender['name'],
            'messages' => $sender['message'],
            'contact' => $sender['contact'],
            'email' => $sender['email']
        ]);
    }
}
