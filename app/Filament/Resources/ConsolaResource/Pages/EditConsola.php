<?php

namespace App\Filament\Resources\ConsolaResource\Pages;

use App\Filament\Resources\ConsolaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConsola extends EditRecord
{
    protected static string $resource = ConsolaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
