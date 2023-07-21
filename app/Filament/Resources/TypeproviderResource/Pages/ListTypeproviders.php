<?php

namespace App\Filament\Resources\TypeproviderResource\Pages;

use App\Filament\Resources\TypeproviderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypeproviders extends ListRecords
{
    protected static string $resource = TypeproviderResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
