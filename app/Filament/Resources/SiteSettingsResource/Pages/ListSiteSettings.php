<?php

namespace App\Filament\Resources\SiteSettingsResource\Pages;

use App\Filament\Resources\SiteSettingsResource;
use App\Models\SiteSettings;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSiteSettings extends ListRecords
{
    protected static string $resource = SiteSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Pas de création - un seul enregistrement de paramètres
        ];
    }

    public function mount(): void
    {
        parent::mount();

        // Rediriger automatiquement vers l'édition du premier enregistrement
        $settings = SiteSettings::first();

        if ($settings) {
            $this->redirect(SiteSettingsResource::getUrl('edit', ['record' => $settings->id]));
        }
    }
}
