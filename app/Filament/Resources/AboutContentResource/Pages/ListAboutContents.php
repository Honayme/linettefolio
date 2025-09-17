<?php

namespace App\Filament\Resources\AboutContentResource\Pages;

use App\Filament\Resources\AboutContentResource;
use App\Models\AboutContent;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutContents extends ListRecords
{
    protected static string $resource = AboutContentResource::class;

    public function mount(): void
    {
        $record = AboutContent::first();

        if ($record) {
            $this->redirect(AboutContentResource::getUrl('edit', ['record' => $record]));
        }

        parent::mount();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
