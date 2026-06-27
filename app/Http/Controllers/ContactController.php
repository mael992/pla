<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        // Demande de clôture de compte (encart affiché pour la catégorie "abonnement")
        $closing = $request->boolean('close_account');

        $request->validate([
            'question_1'     => 'required|string',
            'question_2'     => ($closing ? 'nullable' : 'required') . '|string',
            'message'        => ($closing ? 'nullable' : 'required') . '|string|max:2500',
            'email'          => 'required|email',
            'pdfs.*'         => 'nullable|mimes:pdf|max:10240',
            'images.*'       => 'nullable|image|max:10240',
            'close_username' => $closing ? 'required|string|max:255' : 'nullable|string|max:255',
            'close_email'    => $closing ? 'required|email|max:255'  : 'nullable|email|max:255',
        ]);

        // Sujet et corps : si clôture, on préfixe la demande avec les infos du compte
        $question2 = $request->question_2 ?: ($closing ? __('messages.contact_close_subject') : '');
        $body      = $request->message ?? '';
        if ($closing) {
            $body = trim(
                '[' . __('messages.contact_close_subject') . "]\n"
                . __('messages.contact_close_username') . ' : ' . $request->close_username . "\n"
                . __('messages.contact_close_email') . ' : ' . $request->close_email . "\n\n"
                . $body
            );
        }

        $token  = Str::random(24);
        $count  = Ticket::count();
        $numero = 'T-' . str_pad($count + 1, 4, '0', STR_PAD_LEFT);

        $ticket = Ticket::create([
            'token'      => $token,
            'numero'     => $numero,
            'email'      => $request->email,
            'question_1' => $request->question_1,
            'question_2' => $question2,
            'statut'     => 'ouvert',
        ]);

        $ticketMessage = $ticket->messages()->create([
            'sender' => 'client',
            'body'   => $body,
        ]);

        // Pièces jointes PDF (max 2)
        if ($request->hasFile('pdfs')) {
            $pdfs = array_slice($request->file('pdfs'), 0, 2);
            foreach ($pdfs as $file) {
                $path = $file->store("tickets/{$token}", 'public');
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
                $path = $file->store("tickets/{$token}", 'public');
                $ticketMessage->attachments()->create([
                    'path'          => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type'     => $file->getMimeType(),
                ]);
            }
        }

        ActivityLogger::ticket('CREATE', ($closing ? '[CLÔTURE COMPTE] ' : '') . "Nouveau ticket {$ticket->numero} créé par {$ticket->email} (sujet: {$ticket->question_1} / {$question2})", $ticket->email);

        return redirect()->back()->with('ticket_submitted', true);
    }
}
