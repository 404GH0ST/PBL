<?php

namespace App\Filament\Admin\Resources\ProductAddons\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class ProductAddonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Terapkan untuk Kategori Master')
                    ->searchable()
                    ->required()
                    ->columnSpanFull()
                    ->helperText('Contoh: Pilih "Jersey" agar semua produk berjenis jersey mendapat opsi ini.'),

                TextInput::make('type')
                    ->label('Kategori Opsi (Misal: Bahan, Kerah, Finishing)')
                    ->required()
                    ->datalist([
                        'Material Kain',
                        'Jenis Kerah',
                        'Jenis Lengan',
                        'Ukuran',
                        'Finishing Banner'
                    ]),

                TextInput::make('name')
                    ->label('Nama Spesifik Opsi (Misal: Milano, V-Neck)')
                    ->required(),

                TextInput::make('price')
                    ->label('Biaya Tambahan (Rp)')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->minValue(0)
                    ->helperText('Isi 0 jika variasi ini gratis (Free).'),
            ]);
    }
}
