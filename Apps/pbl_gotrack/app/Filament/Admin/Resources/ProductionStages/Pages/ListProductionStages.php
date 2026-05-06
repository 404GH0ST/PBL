<?php

namespace App\Filament\Admin\Resources\ProductionStages\Pages;

use App\Filament\Admin\Resources\ProductionStages\ProductionStageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductionStages extends ListRecords
{
    protected static string $resource = ProductionStageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
