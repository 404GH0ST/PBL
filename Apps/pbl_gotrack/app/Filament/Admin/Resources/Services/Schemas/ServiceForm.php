<?php

namespace App\Filament\Admin\Resources\Services\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Layanan')
                    ->schema([
                        TextInput::make('title')
                            ->label('Nama Layanan')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('subtitle')
                            ->label('Subjudul / Slogan Singkat')
                            ->maxLength(255),

                        Textarea::make('description')
                            ->label('Deskripsi Lengkap (Ditampilkan di Overlay Full Page)')
                            ->rows(4)
                            ->columnSpanFull(),

                        FileUpload::make('image')
                            ->label('Gambar Layanan')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(2048)
                            ->disk('public')
                            ->directory('services')
                            ->visibility('public')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Pengaturan Tampilan')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ]),
            ]);
    }
}
