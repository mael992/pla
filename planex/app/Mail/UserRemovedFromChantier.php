<?php

namespace App\Mail;

use App\Models\Chantier;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserRemovedFromChantier extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User     $chef,        // destinataire (chef de chantier)
        public Chantier $chantier,
        public string   $removedUsername,
        public string   $removedRole,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[PlanEx] Membre indisponible sur le chantier « ' . $this->chantier->nom . ' »',
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.user-removed-from-chantier');
    }

    public function attachments(): array { return []; }
}
