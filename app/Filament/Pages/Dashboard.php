<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\StatsOverview;
use Filament\Actions\Action;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Page;

class Dashboard extends BaseDashboard
{
    protected string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('portfolio_page')
                ->label('Go to Portfolio')
                ->icon('heroicon-o-sparkles')
                ->action(function () {
                    // Place your button execution logic here
                    // e.g., ExcelExportJob::dispatch();
                }),
        ];
    }
}
