<?php

namespace App\Filament\Resources\Stoks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Models\User;

class StoksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('supplier.supplier_nama')
                    ->label('Supplier')
                    ->searchable(),

                TextColumn::make('barang.barang_nama')
                    ->label('Barang')
                    ->color('secondary')
                    ->badge()
                    ->searchable(),

                TextColumn::make('user.nama')
                    ->label('Kasir')
                    ->searchable(),

                TextColumn::make('stok_tanggal')
                    ->label('Tanggal')
                    ->dateTime('d-m-Y H:i:s')
                    ->sortable()
                    ->color('warning')
                    ->searchable(),

                TextColumn::make('stok_jumlah')
                    ->label('Jumlah')
                    ->color('success'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->visible(fn () => User::isAdminUser()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->visible(fn () => User::isAdminUser()),
                ]),
            ]);
    }
}
