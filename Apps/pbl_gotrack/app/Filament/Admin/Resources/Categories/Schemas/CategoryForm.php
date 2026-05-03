<?php

namespace App\Filament\Admin\Resources\Categories\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
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
                            ->afterStateUpdated(fn($set, $state) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
