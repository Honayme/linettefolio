<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;



    // On ajoute la même méthode ici
    protected function getHeaderActions(): array
    {
        return [
            Action::make('preview')
                ->label('Aperçu')
                ->icon('heroicon-o-eye')
                ->color('gray')
                ->modalContent(function (Action $action) {
                    $data = $action->getForm()->getState();
                    $markdown = $data['full_content'] ?? null;

                    if (!$markdown) {
                        return new HtmlString('<div class="text-gray-500">Commencez à écrire pour voir un aperçu.</div>');
                    }

                    $html = Str::markdown($markdown);
                    return new HtmlString($html);
                })
                ->modalHeading('Aperçu du contenu')
                ->modalSubmitAction(false)
                ->modalCancelActionLabel('Fermer'),
        ];
    }

    protected function getForms(): array
    {
        return [
            'form' => $this->form->model($this->getModel())->statePath('data')->live(),
        ];
    }
}
