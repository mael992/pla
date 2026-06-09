<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanupExpiredTickets extends Command
{
    protected $signature   = 'tickets:cleanup';
    protected $description = 'Supprime les tickets clôturés depuis plus de 15 jours';

    public function handle(): int
    {
        $tickets = Ticket::where('statut', 'cloture')
            ->whereNotNull('delete_at')
            ->where('delete_at', '<=', now())
            ->get();

        $count = 0;
        foreach ($tickets as $ticket) {
            // Supprimer les fichiers du storage
            $dir = "tickets/{$ticket->token}";
            if (Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->deleteDirectory($dir);
            }

            // Supprimer le ticket (cascade sur messages et pièces jointes)
            $ticket->delete();
            $count++;
        }

        $this->info("Nettoyage terminé : {$count} ticket(s) supprimé(s).");

        return Command::SUCCESS;
    }
}
