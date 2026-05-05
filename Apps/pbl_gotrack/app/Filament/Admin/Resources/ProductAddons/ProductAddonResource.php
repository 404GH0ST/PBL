<?php

namespace App\Filament\Admin\Resources\ProductAddons;

use App\Filament\Admin\Resources\ProductAddons\Pages\CreateProductAddon;
use App\Filament\Admin\Resources\ProductAddons\Pages\EditProductAddon;
use App\Filament\Admin\Resources\ProductAddons\Pages\ListProductAddons;
use App\Filament\Admin\Resources\ProductAddons\Schemas\ProductAddonForm;
use App\Filament\Admin\Resources\ProductAddons\Tables\ProductAddonsTable;
use App\Models\ProductAddon;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductAddonResource extends Resource
{
    protected static ?string $model = ProductAddon::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

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
