<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Le site est servi en HTTPS en prod (derrière un proxy) : on force
        // la génération d'URL en https — sauf en local — pour éviter le
        // "mixed content" qui bloque les requêtes fetch/AJAX vers du http://.
        $host = request()->getHost();
        if ($host && !in_array($host, ['localhost', '127.0.0.1', '::1'], true)) {
            URL::forceScheme('https');
        }
    }
}
