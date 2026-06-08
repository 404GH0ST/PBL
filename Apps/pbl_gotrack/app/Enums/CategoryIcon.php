<?php

namespace App\Enums;

use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Icons\Heroicon;

enum CategoryIcon: string implements HasIcon, HasLabel
{
    case Grid = 'grid';
    case Jersey = 'jersey';
    case Banner = 'banner';
    case Dots = 'dots';
    case Printer = 'printer';
    case Shirt = 'shirt';
    case Spark = 'spark';
    case Trophy = 'trophy';
    case Package = 'package';
    case Photo = 'photo';
    case Swatch = 'swatch';
    case Cube = 'cube';
    case Megaphone = 'megaphone';
    case Briefcase = 'briefcase';
    case Store = 'store';

    public function getLabel(): string
    {
        return match ($this) {
            self::Grid => 'Grid',
            self::Jersey => 'Jersey',
            self::Banner => 'Banner',
            self::Dots => 'Titik',
            self::Printer => 'Printer',
            self::Shirt => 'Kaos',
            self::Spark => 'Produk Baru',
            self::Trophy => 'Terlaris',
            self::Package => 'Paket',
            self::Photo => 'Foto',
            self::Swatch => 'Warna',
            self::Cube => 'Produk',
            self::Megaphone => 'Promosi',
            self::Briefcase => 'Bisnis',
            self::Store => 'Toko',
        };
    }

    public function getIcon(): Heroicon
    {
        return match ($this) {
            self::Grid => Heroicon::OutlinedSquares2x2,
            self::Jersey => Heroicon::OutlinedShoppingBag,
            self::Banner => Heroicon::OutlinedBookmark,
            self::Dots => Heroicon::OutlinedEllipsisHorizontal,
            self::Printer => Heroicon::OutlinedPrinter,
            self::Shirt => Heroicon::OutlinedTag,
            self::Spark => Heroicon::OutlinedSparkles,
            self::Trophy => Heroicon::OutlinedTrophy,
            self::Package => Heroicon::OutlinedArchiveBox,
            self::Photo => Heroicon::OutlinedPhoto,
            self::Swatch => Heroicon::OutlinedSwatch,
            self::Cube => Heroicon::OutlinedCube,
            self::Megaphone => Heroicon::OutlinedMegaphone,
            self::Briefcase => Heroicon::OutlinedBriefcase,
            self::Store => Heroicon::OutlinedBuildingStorefront,
        };
    }
}
