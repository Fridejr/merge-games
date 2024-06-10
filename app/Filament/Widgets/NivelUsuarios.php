<?php
namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class NivelUsuarios extends ChartWidget
{
    protected static ?string $heading = 'Usuarios por Nivel';
    protected static ?int $sort = 3;

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        // Obtener la cantidad de usuarios por nivel
        $usersByLevel = User::select('nivel', DB::raw('count(*) as count'))
            ->groupBy('nivel')
            ->orderBy('nivel', 'asc')
            ->get();

        $niveles = [];
        $userCounts = [];

        foreach ($usersByLevel as $user) {
            $nivel = $user->nivel;
            $niveles[] = $nivel;
            $userCounts[$nivel] = $user->count;
        }

        $datasets = [
            [
                'label' => 'Cantidad de Usuarios',
                'data' => array_values($userCounts),
                'backgroundColor' => [
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(255, 205, 86, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)',
                ],
                'borderColor' => '#333',
            ],
        ];

        return [
            'datasets' => $datasets,
            'labels' => $niveles,
        ];
    }
}
