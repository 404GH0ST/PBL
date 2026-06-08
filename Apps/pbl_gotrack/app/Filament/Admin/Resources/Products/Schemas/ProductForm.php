<?php

namespace App\Filament\Admin\Resources\Products\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Product Info')
                        ->description('Isi Informasi Produk')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            TextInput::make('name')
                                ->label('Name')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($set, $state) => $set('slug', Str::slug($state))),
                            TextInput::make('slug')
                                ->label('Sku / Slug')
                                ->required()
                                ->unique(ignoreRecord: true),

                            RichEditor::make('description')
                                ->label('Description')
                                ->columnSpanFull()
                                ->extraInputAttributes(['style' => 'min-height: 300px;']),
                        ])->columns(2),
                    Step::make('Product Price and Stock')
                        ->description('Isi Harga Produk')
                        ->icon('heroicon-o-currency-dollar')
                        ->schema([
                            Select::make('category_id')
                                ->relationship('category', 'name')
                                ->label('Pilih Kategori')
                                ->required()
                                ->preload()
                                ->searchable(),

                            TextInput::make('price')
                                ->label('Harga (Rp)')
                                ->numeric()
                                ->prefix('Rp')
                                ->default(90000)
                                ->required()
                                ->minValue(0),
                        ])->columns(2),

                    // --- STEP 3: GAMBAR & STATUS ---
                    Step::make('Media and status')
                        ->description('Isi Gambar Produk')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            FileUpload::make('image_path')
                                ->label('Upload Gambar Produk')
                                ->image()
                                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                ->maxSize(2048)
                                ->directory('products')
                                ->visibility('public')
                                ->columnSpanFull(),

                            Toggle::make('is_active')
                                ->label('Tampilkan di Katalog?')
                                ->default(true),
                        ]),
                ])
                    ->columnSpanFull() // Membuat wizard melebar penuh (tidak terpotong)
                    ->submitAction(
                        Action::make('save')
                            ->label('Save Product')
                            ->color('primary')
                            ->submit('save')
                    ), // (Opsional) Mengizinkan admin melompat ke step 3 tanpa mengisi step 1
            ]);
    }
}
