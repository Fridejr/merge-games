<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class JugadoresPorDia extends ChartWidget
{
    protected static ?string $heading = 'Usuarios nuevos por día';
    protected static ?int $sort = 2;

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $startDate = Carbon::now()->subDays(14)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $users = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $dates = [];
        $userCounts = [];
        $currentDate = $startDate->copy();

        while ($currentDate->lte($endDate)) {
            $dateKey = $currentDate->format('d/m');
            $dates[] = $dateKey;
            $userCounts[$dateKey] = 0;
            $currentDate->addDay();
        }

        foreach ($users as $user) {
            $dateKey = Carbon::parse($user->date)->format('d/m');
            $userCounts[$dateKey] = $user->count;
        }

        $datasets = [
            [
                'label' => 'Usuarios Nuevos por Día',
                'data' => array_values($userCounts),
                'fill' => 'start',
                'borderColor' => '#de0090',
                'backgroundColor' => 'transparent',
            ],
        ];

        return [
            'datasets' => $datasets,
            'labels' => $dates,
        ];
    }
}
