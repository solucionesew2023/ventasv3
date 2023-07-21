<?php

namespace App\Filament\Resources\TypeproviderResource\Pages;

use App\Filament\Resources\TypeproviderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeprovider extends EditRecord
{
    protected static string $resource = TypeproviderResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
