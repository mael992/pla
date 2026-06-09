<?php

namespace App\Http\Controllers;

use App\Mail\TicketClosed;
use App\Mail\TicketNewReply;
use App\Models\Ticket;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::orderByRaw("FIELD(statut, 'reouverture_demandee', 'ouvert', 'cloture')")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        $ticket->load('messages.attachments');
        return view('admin.tickets.show', compact('ticket'));
    }

    public function reply(Request $request, Ticket $ticket)
    {
        $maxRule = $ticket->no_char_limit_next ? 'required|string' : 'required|string|max:2500';

        $request->validate([
            'body' => $maxRule,
        ]);

        $isFirstAdminReply = $ticket->messages()->where('sender', 'admin')->count() === 0;

        $ticket->messages()->create([
            'sender' => 'admin',
            'body'   => $request->body,
        ]);

        // Remettre no_char_limit_next à false
        $ticket->no_char_limit_next = false;

        // Si admin coche no_char_limit pour le prochain message client
        if ($request->boolean('no_char_limit')) {
            $ticket->no_char_limit_next = true;
        }

        $ticket->save();

        // Envoyer mail au client
        Mail::to($ticket->email)->send(new TicketNewReply($ticket));

        ActivityLogger::ticket('REPLY', "Réponse admin au ticket {$ticket->numero} (client: {$ticket->email})");

        return redirect()->route('admin.tickets.show', $ticket)->with('success', 'Réponse envoyée.');
    }

    public function close(Ticket $ticket)
    {
        $ticket->update([
            'statut'    => 'cloture',
            'closed_at' => now(),
            'delete_at' => now()->addDays(15),
        ]);

        Mail::to($ticket->email)->send(new TicketClosed($ticket));

        ActivityLogger::ticket('CLOSE', "Ticket {$ticket->numero} clôturé (client: {$ticket->email}, suppression prévue: {$ticket->delete_at->format('d/m/Y')})");

        return redirect()->route('admin.tickets.index')->with('success', 'Ticket clôturé.');
    }

    public function acceptReopen(Ticket $ticket)
    {
        $ticket->update([
            'statut'    => 'ouvert',
            'closed_at' => null,
            'delete_at' => null,
        ]);

        Mail::to($ticket->email)->send(new \App\Mail\TicketReopenAccepted($ticket));

        ActivityLogger::ticket('REOPEN_ACCEPTED', "Réouverture acceptée pour ticket {$ticket->numero} (client: {$ticket->email})");

        return redirect()->route('admin.tickets.show', $ticket)->with('success', 'Réouverture acceptée.');
    }

    public function denyReopen(Ticket $ticket)
    {
        $ticket->update([
            'statut'    => 'cloture',
            'delete_at' => now()->addDays(15),
        ]);

        Mail::to($ticket->email)->send(new \App\Mail\TicketReopenDenied($ticket));

        ActivityLogger::ticket('REOPEN_DENIED', "Réouverture refusée pour ticket {$ticket->numero} (client: {$ticket->email})");

        return redirect()->route('admin.tickets.show', $ticket)->with('success', 'Réouverture refusée.');
    }
}
