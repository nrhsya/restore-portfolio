<?php

namespace App\Filament\Widgets;

use App\Models\PageVisit;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class VisitorChart extends ChartWidget
{
    protected ?string $heading = 'Visits — Last 7 Days';

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $startDate = now()->subDays(6)->startOfDay();
        $endDate = now()->endOfDay();

        $visits = PageVisit::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->groupBy(
                fn (PageVisit $visit) => $visit->created_at->format('Y-m-d')
            );

        $labels = [];
        $data = [];

        for ($i = 0; $i < 7; $i++) {
            $date = $startDate->copy()->addDays($i);

            $labels[] = $date->format('D');
            $data[] = $visits->get($date->format('Y-m-d'))?->count() ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Page Visits',
                    'data' => $data,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
