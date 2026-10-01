<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getHeading(): ?string
    {
        return 'Analytics';
    }

    protected function getDescription(): ?string
    {
        return 'An overview of some analytics.';
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Visitors', '192.1k'),
            Stat::make('Page Views', '131'),
            Stat::make('Bounce rate', '21%'),
            Stat::make('Messages', '12'),
        ];
    }
}
