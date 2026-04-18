<?php

namespace App\Filament\Resources\Penjualans\Schemas;

use App\Models\Barang;
use App\Models\PenjualanDetail;
use App\Models\Stok;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section as ComponentsSection;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class PenjualanForm
{
    public static function configure(Schema $schema, $record = null): Schema
    {
        $kasirUser = User::whereHas('level', function ($query) {
            $query->where('level_kode', 'KSR');
        })->first();

        $penjualanId = $record?->penjualan_id;

        return $schema
            ->components([

                Hidden::make('penjualan_kode'),

                // =====================
                // INFORMASI PENJUALAN
                // =====================
                ComponentsSection::make('Informasi Penjualan')
                    ->schema([
                        DateTimePicker::make('penjualan_tanggal')
                            ->required(),

                        TextInput::make('pembeli'),

                        Select::make('user_id')
                            ->label('User/Penjual')
                            ->options(User::all()->pluck('nama', 'user_id'))
                            ->default($kasirUser?->user_id)
                            ->required(),
                    ])
                    ->columns(2),

                // =====================
                // DETAIL BARANG
                // =====================
                ComponentsSection::make('Detail Barang')
                    ->schema([
                        Repeater::make('penjualanDetail')
                            ->relationship('penjualanDetail')
                            ->schema([

                                Select::make('barang_id')
                                    ->label('Barang')
                                    ->options(Barang::all()->pluck('barang_nama', 'barang_id'))
                                    ->required()
                                    ->live()
                                    ->afterStateUpdated(function ($state, $set) {
                                        $barang = Barang::find($state);
                                        if ($barang) {
                                            $set('harga', $barang->harga_jual);
                                        }
                                    }),

                                TextInput::make('jumlah')
                                    ->numeric()
                                    ->required()
                                    ->minValue(1)
                                    ->live()

                                    // sisa stok warna merah
                                    ->helperText(function ($get) use ($penjualanId) {
                                        $barangId = $get('barang_id');
                                        if (!$barangId) return 'Pilih barang terlebih dahulu';

                                        $masuk = Stok::where('barang_id', $barangId)->sum('stok_jumlah');

                                        $keluar = PenjualanDetail::where('barang_id', $barangId)
                                            ->when($penjualanId, function ($q) use ($penjualanId) {
                                                $q->where('penjualan_id', '!=', $penjualanId);
                                            })
                                            ->sum('jumlah');

                                        $stok = $masuk - $keluar;

                                        return new HtmlString("<span style='color:red;'>Sisa stok: {$stok}</span>");
                                    })

                                    // validasi max stok
                                    ->maxValue(function ($get) use ($penjualanId) {
                                        $barangId = $get('barang_id');
                                        if (!$barangId) return 0;

                                        $masuk = Stok::where('barang_id', $barangId)->sum('stok_jumlah');

                                        $keluar = PenjualanDetail::where('barang_id', $barangId)
                                            ->when($penjualanId, function ($q) use ($penjualanId) {
                                                $q->where('penjualan_id', '!=', $penjualanId);
                                            })
                                            ->sum('jumlah');

                                        return max(0, $masuk - $keluar);
                                    }),

                                TextInput::make('harga')
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated(),
                            ])
                            ->addActionLabel('Tambah Barang')
                            ->defaultItems(1),
                    ]),
            ]);
    }
}