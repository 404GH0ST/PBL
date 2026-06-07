<?php

namespace App\Filament\Admin\Resources\Orders;

use App\Filament\Admin\Resources\Orders\Pages\CreateOrder;
use App\Filament\Admin\Resources\Orders\Pages\EditOrder;
use App\Filament\Admin\Resources\Orders\Pages\ListOrders;
use App\Filament\Admin\Resources\Orders\Schemas\OrderForm;
use App\Filament\Admin\Resources\Orders\Tables\OrdersTable;
use App\Filament\Admin\Resources\Orders\Actions\NextProgressAction;
use App\Filament\Admin\Resources\Orders\Actions\UpdatePaymentAction;
use App\Models\Order;
use App\Models\User;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Support\Enums\Width;
use App\Filament\Admin\Resources\Orders\Schemas\OrderInfolist;
use App\Filament\Admin\Resources\Orders\RelationManagers\ProgressRelationManager;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static string|UnitEnum|null $navigationGroup = 'Produksi';
    protected static ?int $navigationSort = 1;


    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'processing')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return OrderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrdersTable::configure($table)->actions([
            ViewAction::make('view')
                ->authorize('view')
                ->modalWidth(Width::TwoExtraLarge)
                ->modalCancelActionLabel('Close'),
            EditAction::make()
                ->authorize('update')
                ->visible(fn(): bool => auth()->user() instanceof User && auth()->user()->isSuperAdmin()),

            NextProgressAction::make(),
            UpdatePaymentAction::make(),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OrderInfolist::configure($schema);
    }

    public static function getRelations(): array
    {
        return [
            ProgressRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrders::route('/'),
            'create' => CreateOrder::route('/create'),
            'edit' => EditOrder::route('/{record}/edit'),
        ];
    }
}
