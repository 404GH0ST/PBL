<?php

namespace App\Filament\Admin\Resources\Faqs\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Konten FAQ')
                    ->schema([
                        TextInput::make('question')
                            ->label('Pertanyaan')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        RichEditor::make('answer')
                            ->label('Jawaban')
                            ->required()
                            ->columnSpanFull()
                            ->extraInputAttributes(['style' => 'min-height: 220px;']),
                    ]),

                Section::make('Pengaturan Tampilan')
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->required(),

                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
