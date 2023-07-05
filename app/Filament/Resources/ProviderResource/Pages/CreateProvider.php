<?php

namespace App\Filament\Resources\ProviderResource\Pages;

use App\Filament\Resources\ProviderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProvider extends CreateRecord
{
    protected static string $resource = ProviderResource::class;

    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}

protected function getCreatedNotificationTitle(): ?string
{
    return 'Provider registered successfully ';
}
}
