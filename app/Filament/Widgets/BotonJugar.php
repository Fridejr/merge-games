<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class BotonJugar extends Widget {
    protected static ?int $sort = 3;
    protected static string $view = 'widgets.boton';
    protected function getViewData(): array
    {
        return [
            'fecha' => now(),
        ];
    }
}
