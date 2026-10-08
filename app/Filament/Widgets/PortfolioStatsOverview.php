<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\PageVisit;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PortfolioStatsOverview extends StatsOverviewWidget
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
        $uniqueVisitors = PageVisit::query()
            ->distinct('session_id')
            ->count('session_id');

        $pageVisits = PageVisit::query()
            ->count();

        $projectViews = PageVisit::query()
            ->where('page_type', 'project')
            ->count();

        $newMessages = ContactMessage::query()
            ->where('status', ContactMessage::STATUS_NEW)
            ->count();

        return [
            Stat::make('Unique Visitors', number_format($uniqueVisitors))
                ->description('Unique browser sessions')
                ->descriptionIcon('heroicon-m-users'),

            Stat::make('Page Visits', number_format($pageVisits))
                ->description('Pages viewed')
                ->descriptionIcon('heroicon-m-eye'),

            Stat::make('Project Views', number_format($projectViews))
                ->description('Project pages viewed')
                ->descriptionIcon('heroicon-m-folder-open'),

            Stat::make('New Messages', number_format($newMessages))
                ->description('Unread inquiries')
                ->descriptionIcon('heroicon-m-envelope'),
        ];
    }
}
