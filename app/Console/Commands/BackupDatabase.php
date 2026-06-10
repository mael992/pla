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

        $command = sprintf(
            '%s -h %s -P %s -u %s %s %s > %s',
            $mysqldump,
            escapeshellarg($host),
            escapeshellarg($port),
            escapeshellarg($user),
            $passwordArg,
            escapeshellarg($db),
            escapeshellarg($filename)
        );

        exec($command . ' 2>&1', $output, $exitCode);

        if ($exitCode !== 0 || !file_exists($filename) || filesize($filename) === 0) {
            $error = implode(' ', $output);
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
