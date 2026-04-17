<?php

namespace App\Filament\Resources\Stoks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class StoksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('supplier.supplier_nama')
                    ->label('Supplier'),

                TextColumn::make('barang.barang_nama')
                    ->label('Barang'),

                TextColumn::make('user.nama')
                    ->label('Kasir'),

                TextColumn::make('stok_tanggal')
                    ->label('Tanggal'),

                TextColumn::make('stok_jumlah')
                    ->label('Jumlah'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
