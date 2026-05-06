<?php

namespace App\Filament\Admin\Resources\ProductionStages;

use App\Filament\Admin\Resources\ProductionStages\Pages\CreateProductionStage;
use App\Filament\Admin\Resources\ProductionStages\Pages\EditProductionStage;
use App\Filament\Admin\Resources\ProductionStages\Pages\ListProductionStages;
use App\Filament\Admin\Resources\ProductionStages\Schemas\ProductionStageForm;
use App\Filament\Admin\Resources\ProductionStages\Tables\ProductionStagesTable;
use App\Models\ProductionStage;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductionStageResource extends Resource
{
    protected static ?string $model = ProductionStage::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-check-circle';
    protected static string|UnitEnum|null $navigationGroup = 'Produksi';
    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ProductionStageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductionStagesTable::configure($table);
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
            'index' => ListProductionStages::route('/'),
            'create' => CreateProductionStage::route('/create'),
            'edit' => EditProductionStage::route('/{record}/edit'),
        ];
    }
}
