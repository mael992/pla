<?php

namespace App\Mail;

use App\Models\Chantier;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ChantierUserAdded extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User     $user,
        public Chantier $chantier,
        public string   $roleLabel
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[PlanEx] Vous avez été ajouté au chantier « ' . $this->chantier->nom . ' »',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.chantier-user-added',
        );
    }

    public function attachments(): array { return []; }
}
