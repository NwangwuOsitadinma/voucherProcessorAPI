<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApproveVoucherMail extends Mailable
{
    use Queueable, SerializesModels;

    public $voucherNumber;
    public $voucherCreatorName;
    public $response;
    public $responderName;
    public $subject = 'RESPONSE TO YOUR VOUCHER';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($voucherNumber, $voucherCreatorName, $response, $responderName)
    {
        $this->voucherNumber = $voucherNumber;
        $this->voucherCreatorName = $voucherCreatorName;
        $this->response = $response;
        $this->responderName = $responderName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.approve-voucher');
    }
}
