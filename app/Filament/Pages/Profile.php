<?php

namespace App\Filament\Pages;

use App\Models\Profile as ProfileModel;
use BackedEnum;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Support\Htmlable;
use UnitEnum;

class Profile extends Page implements HasForms
{
    use InteractsWithActions, InteractsWithForms;

    protected string $view = 'filament.pages.profile';

    protected static string | UnitEnum | null $navigationGroup = 'Profile';

    public ?array $data = [];

    public static function getNavigationIcon(): string | BackedEnum | Htmlable | null
    {
        return 'heroicon-o-user';
    }

    public function mount(): void
    {
        $profile = ProfileModel::first();

        if ($profile) {
            $this->form->fill($profile->toArray());
        }
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Profile')
                    ->description('Basic information displayed on your portfolio.')
                    ->schema([
                        FileUpload::make('profile_image')
                            ->label('Profile Picture')
                            ->image()
                            ->avatar()
                            ->directory('profile')
                            ->disk('public')
                            ->imageEditor()
                            ->columnSpanFull(),

                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('headline')
                            ->label('Professional Title')
                            ->placeholder('Full-Stack Web Developer')
                            ->maxLength(255),

                        Textarea::make('short_bio')
                            ->label('Short Bio')
                            ->rows(4)
                            ->maxLength(1000)
                            ->columnSpanFull(),

                        RichEditor::make('bio')
                            ->label('About Me')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Contact')
                    ->schema([
                        TextInput::make('email')
                            ->email(),

                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel(),

                        FileUpload::make('resume')
                            ->label('Resume')
                            ->directory('resume')
                            ->disk('public')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(10240), // 10MB

                        TextInput::make('location')
                            ->placeholder('Selangor, Malaysia'),
                    ])
                    ->columns(2),

                Section::make('Social Links')
                ->schema([
                    Repeater::make('urls')
                        ->label('Social Links')
                        ->schema([
                            TextInput::make('name')
                                ->label('Name')
                                ->required()
                                ->maxLength(50)
                                ->placeholder('GitHub'),

                            TextInput::make('url')
                                ->label('URL')
                                ->required()
                                ->url()
                                ->placeholder('https://github.com/username'),
                        ])
                        ->columns(2)
                        ->defaultItems(0)
                        ->addActionLabel('Add Social Link')
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                        ->columnSpanFull(),
                ]),

                Section::make('Availability')
                    ->schema([
                        Toggle::make('available_for_work')
                            ->label('Available for work')
                            ->helperText(
                                'Display your availability status on your portfolio.'
                            ),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        ProfileModel::updateOrCreate(
            ['id' => 1],
            $this->form->getState()
        );

        Notification::make()
            ->title('Profile updated successfully')
            ->success()
            ->send();
    }
}
