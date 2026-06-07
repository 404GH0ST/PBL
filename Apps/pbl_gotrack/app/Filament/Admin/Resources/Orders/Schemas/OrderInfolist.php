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

                Section::make('Informasi Pembayaran')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 2,
                        ])
                            ->schema([
                                TextEntry::make('payment_type_label')
                                    ->label('Tipe Pembayaran')
                                    ->badge()
                                    ->color(fn($record): string => $record?->payment_type === 'paid' ? 'success' : 'warning')
                                    ->placeholder('-'),

                                TextEntry::make('payment_status_label')
                                    ->label('Status Pembayaran')
                                    ->badge()
                                    ->color(fn($record): string => $record?->payment_status === 'paid' ? 'success' : 'warning')
                                    ->placeholder('-'),

                                TextEntry::make('total_price')
                                    ->label('Total Pembayaran')
                                    ->formatStateUsing(fn($state): string => self::formatRupiah($state))
                                    ->weight('bold'),

                                TextEntry::make('dp_amount')
                                    ->label('DP / Uang Muka')
                                    ->formatStateUsing(fn($state): string => self::formatRupiah($state)),

                                TextEntry::make('settlement_amount')
                                    ->label('Pelunasan')
                                    ->formatStateUsing(fn($state): string => self::formatRupiah($state)),

                                TextEntry::make('paid_amount')
                                    ->label('Total Dibayar')
                                    ->formatStateUsing(fn($state): string => self::formatRupiah($state))
                                    ->weight('bold'),

                                TextEntry::make('remaining_payment')
                                    ->label('Kekurangan Pembayaran')
                                    ->formatStateUsing(fn($state): string => self::formatRupiah($state))
                                    ->color(fn($state): string => ((int) $state) > 0 ? 'danger' : 'success'),

                                TextEntry::make('paid_at')
                                    ->label('Tanggal Lunas')
                                    ->dateTime('d M Y, H:i')
                                    ->placeholder('-'),
                            ]),
                    ]),
            ]);
    }

    protected static function formatRupiah($state): string
    {
        return 'Rp ' . number_format((float) ($state ?? 0), 0, ',', '.');
    }
}
