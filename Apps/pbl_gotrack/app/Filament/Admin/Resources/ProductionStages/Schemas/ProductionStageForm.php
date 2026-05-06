<?php

namespace App\Filament\Admin\Resources\ProductionStages\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class ProductionStageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Kategori Produk')
                    ->required(),
                TextInput::make('name')
                    ->label('Nama Tahapan Produksi')
                    ->placeholder('Contoh: Proses Cetak Sublim')
                    ->required()
                    ->maxLength(255),
                // Input Sequence DIHAPUS karena sudah otomatis!
            ]);
    }
}
