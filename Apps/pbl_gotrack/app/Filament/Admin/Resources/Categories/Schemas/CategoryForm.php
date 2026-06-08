<?php

namespace App\Filament\Admin\Resources\Categories\Schemas;

use App\Enums\CategoryIcon;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Kategori')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Kategori')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($set, $state) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->columnSpanFull(),

                        Select::make('icon')
                            ->label('Ikon Kategori')
                            ->options(CategoryIcon::class)
                            ->native(false)
                            ->searchable()
                            ->default(CategoryIcon::Grid->value)
                            ->required()
                            ->helperText('Ikon ini dipakai untuk filter kategori di halaman katalog.')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
