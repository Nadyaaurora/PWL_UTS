<?php

namespace App\Filament\Resources\Stoks;

use App\Filament\Resources\Stoks\Pages\CreateStok;
use App\Filament\Resources\Stoks\Pages\EditStok;
use App\Filament\Resources\Stoks\Pages\ListStoks;
use App\Filament\Resources\Stoks\Schemas\StokForm;
use App\Filament\Resources\Stoks\Tables\StoksTable;
use App\Models\Stok;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class StokResource extends Resource
{
    protected static ?string $model = Stok::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static ?string $recordTitleAttribute = 'stok_id';

    protected static ?string $navigationLabel = 'Stok Barang';
    
    protected static ?string $pluralLabel = 'Stok Barang';

    protected static string|UnitEnum|null $navigationGroup = "Transaksi";
    
    public static function form(Schema $schema): Schema
    {
        return StokForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StoksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function canViewAny(): bool
    {
        return true;
    }

    public static function canCreate(): bool
    {
        return User::isAdminUser();
    }

    public static function canEdit(Model $record): bool
    {
        return User::isAdminUser();
    }

    public static function canDelete(Model $record): bool
    {
        return User::isAdminUser();
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStoks::route('/'),
            'create' => CreateStok::route('/create'),
            'edit' => EditStok::route('/{record}/edit'),
        ];
    }

}
