<?php

namespace App\Filament\Resources\HomeContentResource\Pages;

use App\Filament\Resources\HomeContentResource;
use App\Models\HomeContent;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomeContents extends ListRecords
{
    protected static string $resource = HomeContentResource::class;

    public function mount(): void
    {
        $record = HomeContent::first();

        if ($record) {
            $this->redirect(HomeContentResource::getUrl('edit', ['record' => $record]));
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
