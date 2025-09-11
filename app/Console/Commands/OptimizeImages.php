<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\ImageOptimizer\OptimizerChain;

class OptimizeImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:optimize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optimise toutes les images dans storage/app/public/img et ses sous-dossiers';

    private string $baseDirectory;

    private int $totalImages = 0;

    private int $optimizedImages = 0;

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        // Définir le chemin en fonction de l'environnement
        if (app()->environment('production')) {
            // En production, utiliser le chemin vers le dossier storage
            $this->baseDirectory = storage_path('app/public/img');
        } else {
            // En local, utiliser le chemin vers le dossier public/img
            $this->baseDirectory = public_path('img');
        }

        // Vérifier si le dossier existe
        if (! file_exists($this->baseDirectory)) {
            $this->error("Le dossier $this->baseDirectory n'existe pas!");

            return 1;
        }

        $this->info('Début de l\'optimisation des images...');
        $this->optimizeDirectory($this->baseDirectory);

        $this->info('');
        $this->info('Optimisation terminée !');
        $this->info("Total des images traitées : $this->totalImages");
        $this->info("Images optimisées avec succès : $this->optimizedImages");

        return 0;
    }

    private function optimizeDirectory($directory): void
    {
        // Récupère tous les fichiers et dossiers
        $items = scandir($directory);

        foreach ($items as $item) {
            // Ignore . et ..
            if ($item === '.' || $item === '..') {
                continue;
            }

            $path = $directory.DIRECTORY_SEPARATOR.$item;

            if (is_dir($path)) {
                // Si c'est un dossier, on l'explore récursivement
                $this->optimizeDirectory($path);
            } else {
                // Si c'est un fichier, on vérifie si c'est une image
                $this->optimizeFile($path);
            }
        }
    }

    private function optimizeFile($file): void
    {
        // Liste des extensions d'images supportées
        $extensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        if (! in_array($extension, $extensions)) {
            return;
        }

        $this->totalImages++;

        try {
            // Récupère la taille avant optimisation
            $sizeBefore = filesize($file);

            // Optimise l'image
            app(OptimizerChain::class)->optimize($file);

            // Récupère la taille après optimisation
            $sizeAfter = filesize($file);

            // Calcule la réduction en pourcentage
            $reduction = round((($sizeBefore - $sizeAfter) / $sizeBefore) * 100, 2);

            // Affiche le chemin relatif à partir du dossier de base
            $relativePath = str_replace($this->baseDirectory.DIRECTORY_SEPARATOR, '', $file);

            $this->optimizedImages++;
            $this->line("✓ {$relativePath}");
            $this->line("  Réduction: $reduction% (".$this->formatBytes($sizeBefore).' → '.$this->formatBytes($sizeAfter).')');
            $this->line('');
        } catch (\Exception $e) {
            $this->error("Erreur lors de l'optimisation de $file: ".$e->getMessage());
        }
    }

    private function formatBytes($bytes): string
    {
        if ($bytes > 1024 * 1024) {
            return round($bytes / (1024 * 1024), 2).' MB';
        }

        if ($bytes > 1024) {
            return round($bytes / 1024, 2).' KB';
        }

        return $bytes.' B';
    }
}
