<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoginNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $user, $ip, $location, $browser;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $ip, $location, $browser)
    {
        $this->user = $user;
        $this->ip = $ip;
        $this->location = $location;
        $this->browser = $browser;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Login Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.login_notification',
            with: [
                'user_id' => $this->user,
                'ip-' => $this->ip,
                'location' => $this->location,
                'browser' => $this->browser,
            ]
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
