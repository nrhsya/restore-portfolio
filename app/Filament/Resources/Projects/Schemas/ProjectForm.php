<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->live()
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('short_description'),
                Textarea::make('description')
                    ->columnSpanFull(),
                Repeater::make('projectImages')
                    ->relationship()
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->directory('projects'),
                        Toggle::make('is_thumbnail')
                            ->label('Thumbnail')
                            ->default(false),
                    ])
                    ->reorderable('sort_order')
                    ->columnSpanFull(),
                Toggle::make('featured')
                    ->required(),
                Toggle::make('status')
                    ->required(),
                TextInput::make('github_url')
                    ->url(),
                TextInput::make('live_url')
                    ->url(),
                DateTimePicker::make('published_at'),
            ]);
    }
}
