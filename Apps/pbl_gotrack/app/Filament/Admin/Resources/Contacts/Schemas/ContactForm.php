<?php

namespace App\Filament\Admin\Resources\Contacts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
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
                            ->maxLength(255),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Tentang Kami')
                    ->schema([
                        TextInput::make('about_title')
                            ->label('Judul Tentang Kami')
                            ->maxLength(255)
                            ->placeholder('Tentang Kami'),

                        TextInput::make('about_tagline')
                            ->label('Tagline Tentang Kami')
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->placeholder('Solusi Konveksi dan Digital Printing untuk Kebutuhan Personal, Komunitas, dan Bisnis'),

                        Textarea::make('about_description')
                            ->label('Deskripsi Tentang Kami')
                            ->rows(6)
                            ->columnSpanFull()
                            ->placeholder("Deenhag hadir sebagai layanan konveksi...\n\nDengan proses produksi..."),
                    ])
                    ->columns(2),

                Section::make('Kontak Utama')
                    ->schema([
                        TextInput::make('whatsapp_number')
                            ->label('Nomor WhatsApp')
                            ->tel()
                            ->maxLength(255),

                        TextInput::make('phone_number')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),

                        Textarea::make('address')
                            ->label('Alamat')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Google Maps')
                    ->schema([
                        TextInput::make('google_maps_url')
                            ->label('URL Google Maps')
                            ->url()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('google_maps_embed_url')
                            ->label('URL Embed Google Maps')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Sosial Media')
                    ->schema([
                        TextInput::make('facebook_url')
                            ->label('Facebook URL')
                            ->url()
                            ->maxLength(255),

                        TextInput::make('twitter_url')
                            ->label('Twitter URL')
                            ->url()
                            ->maxLength(255),

                        TextInput::make('tiktok_url')
                            ->label('TikTok URL')
                            ->url()
                            ->maxLength(255),

                        TextInput::make('instagram_url')
                            ->label('Instagram URL')
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
