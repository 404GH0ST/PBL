<?php

namespace App\Filament\Admin\Resources\ProductionStages\Pages;

use App\Filament\Admin\Resources\ProductionStages\ProductionStageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductionStage extends CreateRecord
{
    protected static string $resource = ProductionStageResource::class;
}
