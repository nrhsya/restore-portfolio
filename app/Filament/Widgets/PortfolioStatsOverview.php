<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\PageVisit;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PortfolioStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $uniqueVisitors = PageVisit::query()
            ->distinct()
            ->count('session_id');

        $pageVisits = PageVisit::query()
            ->count();

        $projectViews = PageVisit::query()
            ->where('page_type', 'project')
            ->count();

        $newMessages = ContactMessage::query()
            ->where('status', ContactMessage::STATUS_NEW)
            ->count();

        $visitorsToday = PageVisit::query()
            ->whereDate('created_at', today())
            ->distinct()
            ->count('session_id');

        $visitorsLast7Days = PageVisit::query()
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->distinct()
            ->count('session_id');

        $visitorsLast30Days = PageVisit::query()
            ->where('created_at', '>=', now()->subDays(29)->startOfDay())
            ->distinct()
            ->count('session_id');

        return [
            Stat::make(
                'Unique Visitors',
                number_format($uniqueVisitors)
            )
                ->description(
                    number_format($visitorsToday) . ' today'
                )
                ->descriptionIcon('heroicon-m-users'),

            Stat::make(
                'Page Visits',
                number_format($pageVisits)
            )
                ->description(
                    number_format($visitorsLast7Days) . ' visitors in the last 7 days'
                )
                ->descriptionIcon('heroicon-m-eye'),

            Stat::make(
                'Project Views',
                number_format($projectViews)
            )
                ->description(
                    number_format($visitorsLast30Days) . ' visitors in the last 30 days'
                )
                ->descriptionIcon('heroicon-m-folder-open'),

            Stat::make(
                'New Messages',
                number_format($newMessages)
            )
                ->description('Unread inquiries')
                ->descriptionIcon('heroicon-m-envelope'),
        ];
    }
}
