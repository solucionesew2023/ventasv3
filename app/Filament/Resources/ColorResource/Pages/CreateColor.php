<?php

namespace App\Filament\Resources\ColorResource\Pages;

use App\Filament\Resources\ColorResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateColor extends CreateRecord
{
    protected static string $resource = ColorResource::class;

    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}

protected function getCreatedNotificationTitle(): ?string
{
    return 'Color registered successfully ';
}
}
