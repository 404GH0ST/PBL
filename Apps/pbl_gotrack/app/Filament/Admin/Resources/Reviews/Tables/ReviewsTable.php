<?php

namespace App\Filament\Admin\Resources\Reviews\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;

class ReviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order.tracking_id')
                    ->label('No. Resi')
                    ->searchable()
                    ->weight('bold'),
                TextColumn::make('order.customer_name')
                    ->label('Nama Pelanggan')
                    ->searchable(),
                TextColumn::make('product.name')
                    ->label('Produk')
                    ->searchable(),
                TextColumn::make('product_rating')
                    ->label('Kualitas')
                    ->badge()
                    ->color('info')
                    ->formatStateUsing(fn($state) => $state . ' ★'),
                TextColumn::make('service_rating')
                    ->label('Pelayanan')
                    ->badge()
                    ->color('warning')
                    ->formatStateUsing(fn($state) => $state . ' ★'),
                TextColumn::make('comment')
                    ->label('Komentar')
                    ->limit(40),
                ToggleColumn::make('is_visible')
                    ->label('Tampilkan Publik?')
                    ->onColor('success')
                    ->offColor('danger'),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordAction('view')
            ->actions([
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->filters([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
