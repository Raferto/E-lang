<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BidMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user, $barang, $penawaran_barang;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $barang, $penawaran_barang)
    {
        $this->user = $user;
        $this->barang = $barang;
        $this->penawaran_barang = $penawaran_barang;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('e.lang@elang.com')->subject('Penawaran Berhasil!')->view('mail.bid.bidmail');
    }
}
