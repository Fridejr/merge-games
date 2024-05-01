<?php

namespace App\Filament\Resources\ConsolaResource\Pages;

use App\Filament\Resources\ConsolaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConsolas extends ListRecords
{
    protected static string $resource = ConsolaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
