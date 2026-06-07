<?php

namespace App\Filament\Admin\Resources\Orders\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->schema([
                Section::make('Detail Transaksi CetakPro')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 2,
                        ])
                            ->schema([
                                TextEntry::make('tracking_id')
                                    ->label('Nomor Pesanan')
                                    ->weight('bold')
                                    ->color('primary')
                                    ->copyable()
                                    ->placeholder('-'),

                                TextEntry::make('customer_name')
                                    ->label('Nama Customer')
                                    ->placeholder('-'),

                                TextEntry::make('customer_whatsapp')
                                    ->label('WhatsApp Customer')
                                    ->copyable()
                                    ->placeholder('-'),

                                TextEntry::make('status')
                                    ->label('Status')
                                    ->badge()
                                    ->color(fn(?string $state): string => match ($state) {
                                        'pending' => 'warning',
                                        'processing' => 'info',
                                        'shipped' => 'primary',
                                        'completed' => 'success',
                                        'cancelled' => 'danger',
                                        default => 'gray',
                                    })
                                    ->formatStateUsing(fn(?string $state): string => filled($state) ? ucfirst($state) : '-'),

                                TextEntry::make('quantity')
                                    ->label('Jumlah (Pcs)')
                                    ->numeric()
                                    ->placeholder('-'),

                                TextEntry::make('total_price')
                                    ->label('Total Pembayaran')
                                    ->formatStateUsing(fn($state): string => filled($state) ? 'Rp ' . number_format((float) $state, 0, ',', '.') : '-')
                                    ->weight('bold')
                                    ->placeholder('-'),
                            ]),

                        Grid::make(1)
                            ->schema([
                                TextEntry::make('shipping_address')
                                    ->label('Alamat Pengiriman')
                                    ->columnSpanFull()
                                    ->prose()
                                    ->placeholder('-'),

                                TextEntry::make('notes')
                                    ->label('Catatan Customer')
                                    ->columnSpanFull()
                                    ->prose()
                                    ->placeholder('-'),
                            ]),
                    ]),
            ]);
    }
}
