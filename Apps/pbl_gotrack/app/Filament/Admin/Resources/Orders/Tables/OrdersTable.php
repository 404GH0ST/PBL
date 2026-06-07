<?php

namespace App\Filament\Admin\Resources\Orders\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Components\Grid;
use Filament\Support\Enums\Width;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Admin\Resources\Orders\Actions\NextProgressAction;
use App\Models\Order;
use App\Models\User;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tracking_id')
                    ->label('No. Resi')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('customer_name')
                    ->label('Customer')
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'shipped' => 'primary',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->tooltip('Klik untuk melihat detail riwayat') // Memberi petunjuk kursor bahwa ini bisa diklik
                    ->action(
                        Action::make('riwayat_produksi')
                            ->authorize('view')
                            ->modalHeading('Riwayat Tahapan Produksi')
                            ->modalWidth('2xl')
                            ->modalSubmitAction(false) // Hilangkan tombol "Submit"
                            ->modalCancelActionLabel('Tutup')
                            ->infolist([
                                RepeatableEntry::make('progress')
                                    ->label('')
                                    ->contained(true) // Membuat setiap tahapan terbungkus di dalam 'Card'
                                    ->schema([
                                        Grid::make(2)->schema([
                                            // Judul Tahapan (Huruf Besar & Tebal Warna Biru)
                                            TextEntry::make('title')
                                                ->hiddenLabel()
                                                ->weight('bold')
                                                ->color('primary')
                                                ->size('lg'),

                                            // Waktu Eksekusi (Di Kanan)
                                            TextEntry::make('created_at')
                                                ->hiddenLabel()
                                                ->dateTime('d M Y, H:i')
                                                ->color('gray')
                                                ->alignEnd(),

                                            // Nama Kasir (Dengan Icon Orang)
                                            TextEntry::make('staff.name')
                                                ->icon('heroicon-m-user')
                                                ->hiddenLabel()
                                                ->color('gray')
                                                ->default('Sistem'),

                                            // Catatan Tambahan (Muncul jika ada isinya)
                                            TextEntry::make('notes')
                                                ->label('Catatan:')
                                                ->columnSpanFull()
                                                ->visible(fn($state) => filled($state)),

                                            // Foto Dokumentasi (Muncul jika ada isinya)
                                            ImageEntry::make('photo')
                                                ->label('Bukti Dokumentasi:')
                                                ->columnSpanFull()
                                                ->visible(fn($state) => filled($state)),
                                        ]),
                                    ])
                            ])
                    ),

                TextColumn::make('total_price')
                    ->label('Total (Rp)')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordAction('view')
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()
                    ->authorize('view')
                    ->modalWidth(Width::ExtraLarge)
                    ->modalCancelActionLabel('Close'),

                EditAction::make()
                    ->authorize('update')
                    ->visible(fn(): bool => auth()->user() instanceof User && auth()->user()->isSuperAdmin()),

                Action::make('riwayat_produksi')
                    ->authorize('view')
                    ->label('Riwayat')
                    ->icon('heroicon-o-clock')
                    ->color('info')
                    ->modalHeading('Riwayat Tahapan Produksi')
                    ->modalWidth('2xl')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup')
                    ->infolist([
                        RepeatableEntry::make('progress')
                            ->label('')
                            ->contained(true) // Membuat setiap tahapan terbungkus di dalam 'Card'
                            ->schema([
                                Grid::make(2)->schema([
                                    TextEntry::make('title')
                                        ->hiddenLabel()
                                        ->weight('bold')
                                        ->color('primary')
                                        ->size('lg'),

                                    TextEntry::make('created_at')
                                        ->hiddenLabel()
                                        ->dateTime('d M Y, H:i')
                                        ->color('gray')
                                        ->alignEnd(),

                                    // Nama Kasir (Dengan Icon Orang)
                                    TextEntry::make('staff.name')
                                        ->icon('heroicon-m-user')
                                        ->hiddenLabel()
                                        ->color('gray')
                                        ->default('Sistem'),

                                    TextEntry::make('notes')
                                        ->label('Catatan:')
                                        ->columnSpanFull()
                                        ->visible(fn($state) => filled($state)),

                                    ImageEntry::make('photo')
                                        ->label('Bukti Dokumentasi:')
                                        ->columnSpanFull()
                                        ->visible(fn($state) => filled($state)),
                                ]),
                            ]),
                    ]),

                // 4. Tombol Kustom: NEXT PROGRESS
                NextProgressAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->authorize('deleteAny', Order::class)
                        ->visible(fn(): bool => auth()->user() instanceof User && auth()->user()->isSuperAdmin()),
                ]),
            ]);
    }
}
