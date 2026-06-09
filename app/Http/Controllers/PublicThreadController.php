<?php

namespace App\Http\Controllers;

use App\Mail\TicketNewReply;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PublicThreadController extends Controller
{
    public function show(string $token)
    {
        $ticket = Ticket::where('token', $token)->firstOrFail();

        if ($ticket->isExpired()) {
            return view('messages.expired');
        }

        $ticket->load('messages.attachments');

        return view('messages.thread', compact('ticket'));
    }

    public function reply(Request $request, string $token)
    {
        $ticket = Ticket::where('token', $token)->firstOrFail();

        if ($ticket->isExpired()) {
            abort(403, 'Ce ticket a expiré.');
        }

        if ($ticket->statut === 'cloture') {
            return redirect()->route('message.show', $token)->with('error', 'Ce ticket est clôturé. Vous pouvez demander la réouverture.');
        }

        $maxRule = $ticket->no_char_limit_next ? 'required|string' : 'required|string|max:2500';

        $request->validate([
            'body'     => $maxRule,
            'pdfs.*'   => 'nullable|mimes:pdf|max:10240',
            'images.*' => 'nullable|image|max:10240',
        ]);

        $ticketMessage = $ticket->messages()->create([
            'sender' => 'client',
            'body'   => $request->body,
        ]);

        // Pièces jointes PDF (max 2)
        if ($request->hasFile('pdfs')) {
            $pdfs = array_slice($request->file('pdfs'), 0, 2);
            foreach ($pdfs as $file) {
                $path = $file->store("tickets/{$ticket->token}", 'public');
                $ticketMessage->attachments()->create([
                    'path'          => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type'     => $file->getMimeType(),
                ]);
            }
        }

        // Pièces jointes images (max 10)
        if ($request->hasFile('images')) {
            $images = array_slice($request->file('images'), 0, 10);
            foreach ($images as $file) {
                $path = $file->store("tickets/{$ticket->token}", 'public');
                $ticketMessage->attachments()->create([
                    'path'          => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type'     => $file->getMimeType(),
                ]);
            }
        }

        // Notifier l'admin
        Mail::to('roro.informatique26@gmail.com')->send(new TicketNewReply($ticket, true));

        return redirect()->route('message.show', $token)->with('success', 'Votre message a bien été envoyé.');
    }

    public function requestReopen(string $token)
    {
        $ticket = Ticket::where('token', $token)->firstOrFail();

        $ticket->statut = 'reouverture_demandee';
        $ticket->save();

        return redirect()->route('message.show', $token)->with('success', 'Votre demande de réouverture a été envoyée.');
    }
}
