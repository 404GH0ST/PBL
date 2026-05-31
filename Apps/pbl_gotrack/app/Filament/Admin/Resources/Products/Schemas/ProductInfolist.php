<?php

namespace App\Filament\Admin\Resources\Products\Schemas;


use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use App\Models\Product;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make('Product Tabs')
                    ->tabs([
                        // TAB 1: PRODUCT DETAILS
                        Tab::make('Product Details')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Nama Produk')
                                    ->weight('bold')
                                    ->color('primary'),

                                TextEntry::make('slug')
                                    ->label('Slug / SKU')
                                    ->badge()
                                    ->color('success'),

                                TextEntry::make('category.name')
                                    ->label('Kategori')
                                    ->icon('heroicon-m-tag'),

                                TextEntry::make('description')
                                    ->label('Deskripsi Lengkap')
                                    ->html(), // Mengizinkan format RichEditor tampil dengan benar

                                TextEntry::make('created_at')
                                    ->label('Tanggal Dibuat')
                                    ->date('d M Y')
                                    ->color('info'),
                            ]),

                        // TAB 2: PRICING & STOCK
                        Tab::make('Pricing')
                            ->icon('heroicon-o-currency-dollar')
                            ->schema([
                                TextEntry::make('price')
                                    ->label('Harga Satuan')
                                    ->weight('bold')
                                    ->color('primary')
                                    ->icon('heroicon-s-currency-dollar')
                                    // Memastikan format harga tampil rapi sesuai standar Rp 90.000
                                    ->formatStateUsing(fn(string $state): string => 'Rp ' . number_format((float)$state, 0, ',', '.')),

                                // Jika tabelmu memiliki kolom stock, aktifkan baris di bawah ini:
                                /*
                                TextEntry::make('stock')
                                    ->label('Stok Tersedia')
                                    ->weight('bold')
                                    ->badge()
                                    ->color(fn(string $state): string => match (true) {
                                        $state < 5 => 'danger',
                                        $state >= 5 => 'info',
                                        default => 'gray',
                                    }),
                                */
                            ]),

                        // TAB 3: IMAGE & STATUS
                        Tab::make('Image and Status')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                ImageEntry::make('image_path')
                                    ->label('Foto Produk')
                                    ->size(200), // Memperbesar gambar di halaman detail

                                IconEntry::make('is_active')
                                    ->label('Tampil di Katalog?')
                                    ->boolean(),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->vertical(), // Membuat tab berjejer di samping kiri
            ]);
    }
}
