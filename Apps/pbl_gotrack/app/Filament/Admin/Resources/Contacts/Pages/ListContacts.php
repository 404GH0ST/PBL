<?php

namespace App\Filament\Admin\Resources\Contacts\Pages;

use App\Filament\Admin\Resources\Contacts\ContactResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;

    public function mount(): void
    {
        $contact = \App\Models\Contact::first();

        if ($contact) {
            $this->redirect(static::getResource()::getUrl('edit', ['record' => $contact]));
        } else {
            $this->redirect(static::getResource()::getUrl('create'));
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
