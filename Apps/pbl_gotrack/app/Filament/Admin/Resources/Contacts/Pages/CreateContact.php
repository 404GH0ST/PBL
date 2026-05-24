<?php

namespace App\Filament\Admin\Resources\Contacts\Pages;

use App\Filament\Admin\Resources\Contacts\ContactResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContact extends CreateRecord
{
    protected static string $resource = ContactResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
