<?php

namespace App\Filament\Admin\Resources\ProductionStages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\DeleteAction;

class ProductionStagesTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->columns([
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Tahapan Produksi')
                    ->searchable(),
                TextColumn::make('sequence')
                    ->label('Urutan')
                    ->badge() // Tampil cantik seperti badge
                    ->sortable(),
            ])
            ->defaultSort('category_id', 'asc')
            ->reorderable('sequence') // SIHIR DRAG & DROP: Admin bisa geser baris untuk ubah urutan!
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
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
