<?php

namespace App\Filament\Admin\Resources\Reviews\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class ReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('order_id')
                    ->relationship('order', 'tracking_id')
                    ->label('Nomor Resi')
                    ->disabled(),
                TextInput::make('order.customer_name')
                    ->label('Nama Pelanggan')
                    ->formatStateUsing(fn($record) => $record?->order?->customer_name)
                    ->disabled(),
                Select::make('product_id')
                    ->relationship('product', 'name')
                    ->label('Produk yang Dibeli')
                    ->disabled(),
                TextInput::make('product_rating')
                    ->label('Bintang Produk (1-5)')
                    ->disabled(),
                TextInput::make('service_rating')
                    ->label('Bintang Layanan (1-5)')
                    ->disabled(),
                Textarea::make('comment')
                    ->label('Komentar Pelanggan')
                    ->columnSpanFull()
                    ->disabled(),
                Toggle::make('is_visible')
                    ->label('Tampilkan Ulasan di Website?')
                    ->columnSpanFull(),
            ]);
    }
}
