<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketReopenDenied extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Ticket $ticket) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[PlanEx] Votre demande de réouverture du ticket #' . $this->ticket->numero . ' a été refusée',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ticket-reopen-denied',
        );
    }
}
