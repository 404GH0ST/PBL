<?php

namespace App\Filament\Admin\Resources\Contacts\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Contact')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('subtitle')
                            ->label('Subjudul')
                            ->nullable()
                            ->maxLength(255),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->nullable()
                            ->rows(5)
                            ->columnSpanFull(),

                        FileUpload::make('logo')
                            ->label('Logo Website')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(1024)
                            ->disk('public')
                            ->directory('logos')
                            ->visibility('public')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Tentang Kami')
                    ->schema([
                        TextInput::make('about_title')
                            ->label('Judul Tentang Kami')
                            ->nullable()
                            ->maxLength(255)
                            ->placeholder('Tentang Kami'),

                        TextInput::make('about_tagline')
                            ->label('Tagline Tentang Kami')
                            ->nullable()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->placeholder('Solusi Konveksi dan Digital Printing untuk Kebutuhan Personal, Komunitas, dan Bisnis'),

                        Textarea::make('about_description')
                            ->label('Deskripsi Tentang Kami')
                            ->nullable()
                            ->rows(6)
                            ->columnSpanFull()
                            ->placeholder("Deenhag hadir sebagai layanan konveksi...\n\nDengan proses produksi..."),
                    ])
                    ->columns(2),

                Section::make('Kontak Utama')
                    ->schema([
                        TextInput::make('whatsapp_number')
                            ->label('Nomor WhatsApp')
                            ->nullable()
                            ->tel()
                            ->maxLength(255),

                        TextInput::make('phone_number')
                            ->label('Nomor Telepon')
                            ->nullable()
                            ->tel()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Email')
                            ->nullable()
                            ->email()
                            ->maxLength(255),

                        Textarea::make('address')
                            ->label('Alamat')
                            ->nullable()
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Google Maps')
                    ->schema([
                        TextInput::make('google_maps_url')
                            ->label('URL Google Maps')
                            ->nullable()
                            ->url()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('google_maps_embed_url')
                            ->label('URL Embed Google Maps')
                            ->nullable()
                            ->url()
                            ->maxLength(2048)
                            ->columnSpanFull(),
                    ]),

                Section::make('Sosial Media')
                    ->schema([
                        TextInput::make('facebook_url')
                            ->label('Facebook URL')
                            ->nullable()
                            ->url()
                            ->maxLength(255),

                        TextInput::make('twitter_url')
                            ->label('Twitter URL')
                            ->nullable()
                            ->url()
                            ->maxLength(255),

                        TextInput::make('tiktok_url')
                            ->label('TikTok URL')
                            ->nullable()
                            ->url()
                            ->maxLength(255),

                        TextInput::make('instagram_url')
                            ->label('Instagram URL')
                            ->nullable()
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Status')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->helperText('Jika diaktifkan, contact aktif lain akan otomatis dinonaktifkan.')
                            ->default(false),
                    ]),
            ]);
    }
}
