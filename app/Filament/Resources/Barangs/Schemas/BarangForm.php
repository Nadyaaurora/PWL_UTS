<?php

namespace App\Filament\Resources\Barangs\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class BarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('barang_kode')
                    ->label('Kode Barang')
                    ->required(),

                TextInput::make('barang_nama')
                    ->label('Nama Barang')
                    ->required(),

                Select::make('kategori_id')
                    ->label('Kategori')
                    ->relationship('kategori', 'kategori_nama')
                    ->searchable()
                    ->required(),

                TextInput::make('harga_beli')
                    ->label('Harga Beli')
                    ->numeric()
                    ->required(),

                TextInput::make('harga_jual')
                    ->label('Harga Jual')
                    ->numeric()
                    ->required(),
                            ]);
    }
}
