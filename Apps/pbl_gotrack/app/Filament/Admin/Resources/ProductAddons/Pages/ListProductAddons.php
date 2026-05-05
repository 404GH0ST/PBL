<?php

namespace App\Filament\Admin\Resources\ProductAddons\Pages;

use App\Filament\Admin\Resources\ProductAddons\ProductAddonResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductAddons extends ListRecords
{
    protected static string $resource = ProductAddonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
