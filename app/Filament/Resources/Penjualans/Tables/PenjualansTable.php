<?php

namespace App\Filament\Resources\Penjualans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class PenjualansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('penjualan_id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('user.nama')
                    ->label('Kasir')
                    ->sortable(),

                TextColumn::make('tanggal')
                    ->date()
                    ->label('Tanggal'),

                TextColumn::make('total_harga')
                    ->money('IDR')
                    ->label('Total'),
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
