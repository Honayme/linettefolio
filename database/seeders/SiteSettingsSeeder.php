<?php

namespace Database\Seeders;

use App\Models\SiteSettings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer un enregistrement par défaut pour les paramètres du site
        SiteSettings::firstOrCreate(
            ['id' => 1],
            [
                'logo' => null,
                'logo_alt' => 'Logo du site',
                'favicon' => null,
            ]
        );
    }
}
