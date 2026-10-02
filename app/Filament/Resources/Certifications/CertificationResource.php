<?php

namespace App\Filament\Resources\Certifications;

use App\Filament\Resources\Certifications\Pages\CreateCertification;
use App\Filament\Resources\Certifications\Pages\EditCertification;
use App\Filament\Resources\Certifications\Pages\ListCertifications;
use App\Filament\Resources\Certifications\Schemas\CertificationForm;
use App\Filament\Resources\Certifications\Tables\CertificationsTable;
use App\Models\Certification;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use UnitEnum;

class CertificationResource extends Resource
{
    protected static ?string $model = Certification::class;

    protected static string | UnitEnum | null $navigationGroup = 'Portfolio Management';

    public static function getNavigationIcon(): string | BackedEnum | Htmlable | null
    {
        return 'heroicon-o-trophy';
    }

    public static function form(Schema $schema): Schema
    {
        return CertificationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CertificationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCertifications::route('/'),
            'create' => CreateCertification::route('/create'),
            'edit' => EditCertification::route('/{record}/edit'),
        ];
    }
}
