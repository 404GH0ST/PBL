<?php

namespace App\Filament\Admin\Resources\ProductionStages\Pages;

use App\Filament\Admin\Resources\ProductionStages\ProductionStageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProductionStage extends EditRecord
{
    protected static string $resource = ProductionStageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
