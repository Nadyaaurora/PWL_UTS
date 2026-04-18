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
                    ->label('Kasir')
                    ->searchable(),

                TextColumn::make('pembeli')
                    ->label('Pembeli')
                    ->color('info')
                    ->searchable(),

                TextColumn::make('penjualan_kode')
                    ->label('Kode Penjualan')
                    ->color('gray')
                    ->searchable()
                    ->badge(),

                TextColumn::make('penjualan_tanggal')
                    ->label('Tanggal')
                    ->dateTime('d-m-Y H:i:s')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('total')
                    ->label('Total')
                    ->sortable()
                    ->color('danger')
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
