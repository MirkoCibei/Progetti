<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\EmailSents;

class ContactVendor extends Mailable
{
    use Queueable, SerializesModels;

    

    /**
     * Create a new message instance.
     */
    public $user;
    public $emailSents;

   


    public function __construct(User $user)
    {
        $this->user = $user;
        $this->emailSents = EmailSents::where('sending_user_id',auth()->user()->id)->take(1)->orderBy('created_at', 'desc')->get();
        //dd($this->emailSents,$this->user);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'un utente vuole contattarti',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.contact_vendor',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
