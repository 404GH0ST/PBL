<?php

namespace App\Filament\Admin\Resources\Posts\Tables;

use App\Models\Post;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('Gambar')
                    ->disk('public')
                    ->defaultImageUrl(fn ($record) => $record->image_url)
                    ->circular(),

                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(['title', 'excerpt'])
                    ->sortable()
                    ->limit(50),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Post::STATUS_PUBLISHED => 'success',
                        Post::STATUS_ARCHIVED => 'gray',
                        default => 'warning',
                    })
                    ->formatStateUsing(fn (string $state): string => Post::STATUSES[$state] ?? Str::headline($state)),

                TextColumn::make('published_at')
                    ->label('Tanggal Publikasi')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(Post::STATUSES),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                ViewAction::make(),
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
