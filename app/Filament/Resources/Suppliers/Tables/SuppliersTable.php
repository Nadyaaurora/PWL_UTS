<?php

namespace App\Filament\Resources\Suppliers\Tables;

use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SuppliersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('supplier_kode')
                    ->label('Kode')
                    ->badge()
                    ->color('primary')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('supplier_nama')
                    ->label('Nama Supplier')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('supplier_alamat')
                    ->label('Alamat') 
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Delete Selected'),
                ]),
            ]);
    }
}
