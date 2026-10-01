<?php

namespace App\Filament\Resources\Certifications\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CertificationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('issuer')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                DatePicker::make('issue_date'),
                DatePicker::make('expiry_date'),
                TextInput::make('credential_id'),
                TextInput::make('credential_url')
                    ->url(),
                FileUpload::make('certificate_image')
                    ->image(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
