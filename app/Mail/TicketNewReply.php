<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketNewReply extends Mailable
{
    use Queueable, SerializesModels;

    public bool $toAdmin;

    public function __construct(
        public Ticket $ticket,
        bool $toAdmin = false
    ) {
        $this->toAdmin = $toAdmin;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[PlanEx] Nouveau message sur votre ticket #' . $this->ticket->numero,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ticket-new-reply',
        );
    }
}
