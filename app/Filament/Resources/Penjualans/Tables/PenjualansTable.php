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
                TextColumn::make('user.nama')
                    ->label('Kasir'),

                TextColumn::make('pembeli')
                    ->label('Pembeli'),

                TextColumn::make('penjualan_kode')
                    ->label('Kode Penjualan'),

                TextColumn::make('penjualan_tanggal')
                    ->label('Tanggal'),
                    
                TextColumn::make('total')
                    ->label('Total')
                    ->getStateUsing(function ($record) {
                        return $record->penjualanDetail->sum(function ($item) {
                            return $item->harga * $item->jumlah;
                        });
                    })
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
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
