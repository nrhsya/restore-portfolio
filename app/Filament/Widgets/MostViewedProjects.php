<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class MostViewedProjects extends TableWidget
{
    protected static ?string $heading = 'Most Viewed Projects';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Project::query()
                    ->where('status', true)
                    ->withCount([
                        'pageVisits as views_count',
                    ])
                    ->orderByDesc('views_count')
                    // ->limit(5)
            )
            ->columns([
                TextColumn::make('title')
                    ->label('Project'),

                TextColumn::make('views_count')
                    ->label('Views')
                    ->numeric()
                    ->sortable(),
            ])
            ->paginated(false);
    }
}
