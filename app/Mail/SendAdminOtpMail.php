<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAdminOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otpCode;
    public $userName;
    public $purpose;
    public $customSubject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($otpCode, $userName = 'Admin', $purpose = 'verifikasi', $customSubject = null)
    {
        $this->otpCode = $otpCode;
        $this->userName = $userName;
        $this->purpose = $purpose;
        $this->customSubject = $customSubject ?: 'Kode Verifikasi OTP - Boutique Design Indonesia';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->customSubject)
                    ->view('emails.admin_otp');
    }
}
