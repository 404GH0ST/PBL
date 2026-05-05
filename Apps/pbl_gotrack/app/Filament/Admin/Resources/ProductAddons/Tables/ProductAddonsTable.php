<?php

namespace App\Filament\Admin\Resources\ProductAddons\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ProductAddonsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category.name')
                    ->label('Kategori Master')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color('primary'),

                TextColumn::make('type')
                    ->label('Tipe Opsi')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('name')
                    ->label('Nama Variasi')
                    ->searchable(),

                TextColumn::make('price')
                    ->label('Tambahan Biaya')
                    ->money('IDR')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
