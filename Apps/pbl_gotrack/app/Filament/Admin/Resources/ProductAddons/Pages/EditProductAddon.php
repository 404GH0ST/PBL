<?php

namespace App\Filament\Admin\Resources\ProductAddons\Pages;

use App\Filament\Admin\Resources\ProductAddons\ProductAddonResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProductAddon extends EditRecord
{
    protected static string $resource = ProductAddonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
