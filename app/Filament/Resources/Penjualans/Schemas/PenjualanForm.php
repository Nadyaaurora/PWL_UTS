<?php

namespace App\Filament\Resources\Penjualans\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
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

            DatePicker::make('tanggal')
                ->label('Tanggal')
                ->required(),

            TextInput::make('total_harga')
                ->label('Total Harga')
                ->numeric()
                ->required(),
            ]);
    }
}
