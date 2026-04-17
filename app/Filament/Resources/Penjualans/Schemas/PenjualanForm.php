<?php

namespace App\Filament\Resources\Penjualans\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;

class PenjualanForm
{
    public static function configure(Schema $schema): Schema
{
    return $schema
        ->components([
            Select::make('user_id')
                ->label('Kasir')
                ->relationship('user', 'nama')
                ->required(),

            TextInput::make('pembeli')
                ->label('Nama Pembeli')
                ->required(),

            TextInput::make('penjualan_kode')
                ->label('Kode Penjualan')
                ->required(),

            DateTimePicker::make('penjualan_tanggal')
                ->label('Tanggal Penjualan')
                ->required(),
            ]);
    }
}
