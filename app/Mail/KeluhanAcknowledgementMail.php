<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KeluhanAcknowledgementMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user, $keluhan, $penerima;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $keluhan, $penerima)
    {
        $this->user = $user;
        $this->keluhan = $keluhan;
        $this->penerima = $penerima;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('e.lang@elang.com')->subject('Keluhan')->view('mail.keluhan.ack');
    }
}
