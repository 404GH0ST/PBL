<?php

namespace App\Filament\Admin\Resources\Posts\Schemas;

use App\Models\Post;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Post')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($set, $state) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),

                        Textarea::make('excerpt')
                            ->label('Ringkasan')
                            ->rows(3)
                            ->columnSpanFull(),

                        RichEditor::make('content')
                            ->label('Konten')
                            ->required()
                            ->columnSpanFull()
                            ->extraInputAttributes(['style' => 'min-height: 300px;']),
                    ])
                    ->columns(2),

                Section::make('Publikasi')
                    ->schema([
                        FileUpload::make('featured_image')
                            ->label('Gambar Utama')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(2048)
                            ->disk('public')
                            ->directory('posts')
                            ->visibility('public')
                            ->columnSpanFull(),

                        Select::make('status')
                            ->label('Status')
                            ->options(Post::STATUSES)
                            ->default(Post::STATUS_DRAFT)
                            ->required(),

                        DateTimePicker::make('published_at')
                            ->label('Tanggal Publikasi')
                            ->helperText('Isi tanggal publikasi ketika status post Published.'),
                    ])
                    ->columns(2),
            ]);
    }
}
