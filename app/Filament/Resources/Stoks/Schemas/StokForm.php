<?php

namespace App\Filament\Resources\Stoks\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;

class StokForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('supplier_id')
                    ->label('Supplier')
                    ->relationship('supplier', 'supplier_nama')
                    ->required(),
                Select::make('barang_id')
                    ->label('Barang')
                    ->relationship('barang', 'barang_nama')
                    ->required(),
                Select::make('user_id')
                    ->label('Kasir')
                    ->relationship('user', 'nama')
                    ->required(),
                DateTimePicker::make('stok_tanggal')
                    ->label('Tanggal')
                    ->required(),

                TextInput::make('stok_jumlah')
                    ->label('Jumlah Stok')
                    ->numeric()
                    ->required(),
            ]);
    }
}
