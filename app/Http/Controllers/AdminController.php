<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Tableau d'administration unifié : utilisateurs, messages, logs.
     */
    public function dashboard()
    {
        $usersCount    = User::count();
        $ticketsOpen   = Ticket::where('statut', 'ouvert')->count();
        $ticketsReopen = Ticket::where('statut', 'reouverture_demandee')->count();

        $logDir   = storage_path('logs/activity');
        $logFiles = is_dir($logDir) ? count(glob($logDir . '/activity-*.log') ?: []) : 0;

        return view('admin.dashboard', compact(
            'usersCount', 'ticketsOpen', 'ticketsReopen', 'logFiles'
        ));
    }
}
