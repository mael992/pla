<?php

namespace App\Console\Commands;

use App\Services\ActivityLogger;
use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    protected $signature   = 'db:backup';
    protected $description = 'Sauvegarde la base de données MySQL (mysqldump) dans storage/app/backups/';

    public function handle(): int
    {
        $backupDir = storage_path('app/backups');

        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0775, true);
        }

        $db       = config('database.connections.mysql.database');
        $user     = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host     = config('database.connections.mysql.host');
        $port     = config('database.connections.mysql.port');

        $filename = $backupDir . '/backup_' . now()->format('Y-m-d_H-i-s') . '.sql';

        // Chemin mysqldump : XAMPP Windows ou standard Linux/Mac
        $mysqldump = file_exists('C:\\xampp\\mysql\\bin\\mysqldump.exe')
            ? '"C:\\xampp\\mysql\\bin\\mysqldump.exe"'
            : 'mysqldump';

        $passwordArg = $password !== '' ? '-p' . escapeshellarg($password) : '';

        // Le conteneur Docker embarque le client MariaDB, qui vérifie par défaut
        // le certificat du serveur. Or MySQL 8.4 chiffre la connexion avec un
        // certificat auto-signé : sans cette option, mysqldump refuse de se
        // connecter (« TLS/SSL error: self-signed certificate in certificate
        // chain »). La liaison reste chiffrée, on ne vérifie simplement pas
        // l'autorité — la base n'est joignable que sur le réseau interne Docker.
        // Le client MySQL (XAMPP) ne connaît pas cette option : on ne l'ajoute
        // que lorsque le client est bien MariaDB.
        $optionsTls = str_contains($this->versionClient($mysqldump), 'MariaDB')
            ? ' --ssl-verify-server-cert=0'
            : '';

        // Sans --no-tablespaces, mysqldump réclame le privilège PROCESS et écrit
        // un avertissement, que l'utilisateur de l'application n'a pas besoin
        // d'avoir : on ne sauvegarde pas les tablespaces.
        $erreurs = $backupDir . '/.mysqldump-erreurs.log';

        $command = sprintf(
            '%s --no-tablespaces%s -h %s -P %s -u %s %s %s > %s 2> %s',
            $mysqldump,
            $optionsTls,
            escapeshellarg($host),
            escapeshellarg($port),
            escapeshellarg($user),
            $passwordArg,
            escapeshellarg($db),
            escapeshellarg($filename),
            escapeshellarg($erreurs)
        );

        // La sortie d'erreur part dans un fichier à part : redirigée avec « 2>&1 »
        // elle atterrissait DANS le fichier .sql, qui devenait inutilisable pour
        // une restauration, et le message d'échec affiché restait vide.
        exec($command, $output, $exitCode);

        $messageErreur = is_file($erreurs) ? trim((string) file_get_contents($erreurs)) : '';
        @unlink($erreurs);

        if ($exitCode !== 0 || !file_exists($filename) || filesize($filename) === 0) {
            $error = $messageErreur !== '' ? $messageErreur : implode(' ', $output);
            // On ne garde pas un fichier tronqué : il ferait croire à une
            // sauvegarde valide et occuperait une des 30 places conservées.
            if (file_exists($filename)) {
                @unlink($filename);
            }
            $this->error("Échec de la sauvegarde : {$error}");
            ActivityLogger::system('BACKUP', "ÉCHEC sauvegarde BDD : {$error}");
            return Command::FAILURE;
        }

        $size = round(filesize($filename) / 1024, 1);
        $this->info("Sauvegarde créée : {$filename} ({$size} Ko)");
        ActivityLogger::system('BACKUP', "Sauvegarde BDD créée : backup_" . now()->format('Y-m-d_H-i-s') . ".sql ({$size} Ko)");

        // Garder les 30 dernières sauvegardes
        $this->pruneOldBackups($backupDir, 30);

        return Command::SUCCESS;
    }

    /**
     * Renvoie la bannière de version du client (« mysqldump from 11.8.6-MariaDB… »),
     * qui permet de distinguer le client MariaDB du client MySQL.
     */
    private function versionClient(string $mysqldump): string
    {
        $sortie   = [];
        $codeSortie = 0;

        exec($mysqldump . ' --version 2>&1', $sortie, $codeSortie);

        return $codeSortie === 0 ? implode(' ', $sortie) : '';
    }

    private function pruneOldBackups(string $dir, int $keep): void
    {
        $files = glob($dir . '/backup_*.sql') ?: [];

        usort($files, fn($a, $b) => filemtime($b) - filemtime($a));

        foreach (array_slice($files, $keep) as $old) {
            unlink($old);
            $this->line('Ancienne sauvegarde supprimée : ' . basename($old));
        }
    }
}
