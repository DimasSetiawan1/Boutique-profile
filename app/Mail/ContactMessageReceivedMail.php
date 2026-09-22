<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ContactMessage;

class ContactMessageReceivedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ContactMessage $contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subjectText = !empty($this->contactMessage->subject)
            ? '[Pesan Masuk Baru] ' . $this->contactMessage->subject . ' - Dari ' . $this->contactMessage->name
            : '[Pesan Masuk Baru] Inquiry dari ' . $this->contactMessage->name . ' - Boutique Design';

        return $this->subject($subjectText)
                    ->replyTo($this->contactMessage->email, $this->contactMessage->name)
                    ->view('emails.contact_message_received', [
                        'msg' => $this->contactMessage,
                    ]);
    }
}
