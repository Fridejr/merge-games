<?php

namespace App\Filament\Resources\TableroResource\Pages;

use App\Filament\Resources\TableroResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTableros extends ListRecords
{
    protected static string $resource = TableroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
