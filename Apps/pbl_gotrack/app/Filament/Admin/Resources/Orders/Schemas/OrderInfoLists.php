<?php

namespace App\Filament\Admin\Resources\Orders\Infolists;


use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;


class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Detail Transaksi CetakPro')
                    ->schema([
                        TextEntry::make('tracking_id')->label('Nomor Pesanan')->weight('bold')->color('primary'),
                        TextEntry::make('user.name')->label('Nama Customer'),
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'pending' => 'warning',
                                'processing' => 'info',
                                'completed' => 'success',
                                'cancelled' => 'danger',
                                default => 'gray',
                            }),
                        TextEntry::make('quantity')->label('Jumlah (Pcs)'),
                        TextEntry::make('total_price')
                            ->label('Total Pembayaran')
                            ->formatStateUsing(fn(string $state): string => 'Rp ' . number_format((float)$state, 0, ',', '.')),
                        TextEntry::make('notes')->label('Catatan Customer')->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
