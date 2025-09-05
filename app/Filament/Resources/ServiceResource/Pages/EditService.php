<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;


    protected function getHeaderActions(): array
    {
        return [
            // L'action "Aperçu"
            Action::make('preview')
                ->label('Aperçu')
                ->icon('heroicon-o-eye')
                ->color('gray')
                // 👇 C'est ici que la magie opère
                ->modalContent(function ($get) {
                    $markdown = $get('full_content'); // On lit le contenu ACTUEL du formulaire

                    if (!$markdown) {
                        return new HtmlString('<div class="text-gray-500">Commencez à écrire pour voir un aperçu.</div>');
                    }

                    $html = Str::markdown($markdown);

                    // Crucial pour que le HTML soit interprété
                    return new HtmlString($html);
                })
                ->modalHeading('Aperçu du contenu')
                ->modalSubmitAction(false) // On cache le bouton de confirmation
                ->modalCancelActionLabel('Fermer'),

            // On conserve les actions par défaut (comme "Supprimer")
            Actions\DeleteAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        return parent::form($form)
            ->statePath('data')
            ->live();
    }

}
