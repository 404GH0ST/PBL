<?php

namespace App\Filament\Admin\Resources\Orders\RelationManagers;

use App\Models\ProductionStage;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProgressRelationManager extends RelationManager
{
    protected static string $relationship = 'progress';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('production_stage_id')
                    ->label('Tahapan Produksi')
                    ->required()
                    ->options(function (RelationManager $livewire) {
                        $categoryId = $livewire->getOwnerRecord()->product?->category_id;
                        if (! $categoryId) {
                            return [];
                        }

                        return ProductionStage::where('category_id', $categoryId)
                            ->orderBy('sequence')
                            ->pluck('name', 'id');
                    }),
                Textarea::make('notes')
                    ->label('Catatan'),
                FileUpload::make('photo')
                    ->label('Foto Bukti')
                    ->directory('orders/progress-photos')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxSize(2048),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('notes')
            ->columns([
                TextColumn::make('productionStage.name')->label('Tahapan')->badge(),
                TextColumn::make('notes')->label('Catatan'),
                ImageColumn::make('photo')->label('Foto Bukti'),
                TextColumn::make('created_at')->label('Tanggal')->dateTime(),
            ])
            ->actions([
                EditAction::make(), // TOMBOL EDIT PROGRESS LAMA
                DeleteAction::make(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
