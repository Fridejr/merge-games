<?php

namespace App\Filament\Resources\TableroResource\Pages;

use App\Filament\Resources\TableroResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTablero extends EditRecord
{
    protected static string $resource = TableroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
