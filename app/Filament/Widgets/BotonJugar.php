<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class BotonJugar extends Widget {
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';
    protected static string $view = 'widgets.boton';
    protected function getViewData(): array
    {
        return [
            'fecha' => now(),
        ];
    }

    protected function getColumns(): int | array
    {
        return 2;
    }
}
