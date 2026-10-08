<?php

namespace App\Filament\Widgets;

use App\Models\PageVisit;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TrafficSources extends StatsOverviewWidget
{
    protected ?string $heading = 'Traffic Sources';

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $visits = PageVisit::query()
            ->select('referrer')
            ->get();

        $sources = $visits
            ->map(fn (PageVisit $visit): string => $this->getSource($visit->referrer))
            ->countBy()
            ->sortDesc();

        return $sources
            ->map(
                fn (int $count, string $source): Stat =>
                    Stat::make($source, number_format($count))
                        ->description('Visits')
                        ->descriptionIcon('heroicon-m-arrow-trending-up')
            )
            ->values()
            ->all();
    }

    /*
    - Direct = no source provided
    - Google = clicked the link through Google
    - GitHub = clicked the link through GitHub (from github profile)
    - etc.
    */
    private function getSource(?string $referrer): string
    {
        if (blank($referrer)) {
            return 'Direct';
        }

        $host = parse_url($referrer, PHP_URL_HOST);

        if (! is_string($host)) {
            return 'Other';
        }

        $host = strtolower($host);

        return match (true) {
            str_contains($host, 'google.') => 'Google',

            $host === 'github.com'
                || str_ends_with($host, '.github.com') => 'GitHub',

            $host === 'linkedin.com'
                || str_ends_with($host, '.linkedin.com') => 'LinkedIn',

            $host === 'facebook.com'
                || str_ends_with($host, '.facebook.com')
                || $host === 'fb.com'
                || str_ends_with($host, '.fb.com') => 'Facebook',

            $host === 'instagram.com'
                || str_ends_with($host, '.instagram.com') => 'Instagram',

            $host === 'x.com'
                || str_ends_with($host, '.x.com')
                || $host === 'twitter.com'
                || str_ends_with($host, '.twitter.com')
                || $host === 't.co' => 'X / Twitter',

            default => 'Other',
        };
    }
}
