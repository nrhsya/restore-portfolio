<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
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
                Select::make('skills')
                    ->relationship('skills', 'name')
                    ->multiple()
                    ->preload(),
                Section::make('Project Images')
                    ->description(
                        'Add images to showcase your project. You can upload multiple images and reorder them as needed.'
                    )
                    ->schema([
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
                    ])
                    ->collapsible()
                    ->columnSpanFull(),
                Section::make('Case Study')
                    ->description(
                        'Add sections to explain the story, decisions, challenges, and outcomes of this project.'
                    )
                    ->schema([
                        Repeater::make('sections')
                            ->label('Sections')
                            ->relationship()
                            ->orderColumn('sort_order')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Section Title')
                                    ->placeholder('e.g. The Problem')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true),

                                RichEditor::make('content')
                                    ->label('Content')
                                    ->required()
                                    ->columnSpanFull(),
                            ])
                            ->itemLabel(
                                fn (array $state): ?string =>
                                    $state['title'] ?? 'New Section'
                            )
                            ->addActionLabel('Add Section')
                            ->collapsible()
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
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
