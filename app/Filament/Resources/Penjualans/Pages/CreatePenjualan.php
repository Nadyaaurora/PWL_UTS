<?php

namespace App\Filament\Resources\Penjualans\Pages;

use App\Filament\Resources\Penjualans\PenjualanResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Barang;

class CreatePenjualan extends CreateRecord
{
    protected static string $resource = PenjualanResource::class;
    
    protected function afterCreate(): void
    {
        //
    }
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['penjualan_kode'] = 'TRX-' . time();

        return $data;
}
}


