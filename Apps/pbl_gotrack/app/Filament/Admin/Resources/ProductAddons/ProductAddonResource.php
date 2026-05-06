<?php

namespace App\Filament\Admin\Resources\ProductAddons;

use App\Filament\Admin\Resources\ProductAddons\Pages\CreateProductAddon;
use App\Filament\Admin\Resources\ProductAddons\Pages\EditProductAddon;
use App\Filament\Admin\Resources\ProductAddons\Pages\ListProductAddons;
use App\Filament\Admin\Resources\ProductAddons\Schemas\ProductAddonForm;
use App\Filament\Admin\Resources\ProductAddons\Tables\ProductAddonsTable;
use App\Models\ProductAddon;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductAddonResource extends Resource
{
    protected static ?string $model = ProductAddon::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-puzzle-piece';
    protected static string|UnitEnum|null $navigationGroup = 'Katalog';
    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ProductAddonForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductAddonsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductAddons::route('/'),
            'create' => CreateProductAddon::route('/create'),
            'edit' => EditProductAddon::route('/{record}/edit'),
        ];
    }
}
