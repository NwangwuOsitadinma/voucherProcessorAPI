<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateVoucherMail extends Mailable
{
    use Queueable, SerializesModels;

    public $voucherNumber;
    public $creatorEmail;
    public $creatorName;
    public $officeEntity;
    public $subject = 'A voucher has just been created';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($voucherNumber, $creatorEmail, $creatorName, $officeEntity)
    {
        $this->voucherNumber = $voucherNumber;
        $this->creatorEmail = $creatorEmail;
        $this->creatorName = $creatorName;
        $this->officeEntity = $officeEntity;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.create-voucher');
    }
}
