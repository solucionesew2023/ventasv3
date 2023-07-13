<?php

namespace App\Filament\Resources\CreditpurchaseResource\Pages;

use App\Filament\Resources\CreditpurchaseResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCreditpurchases extends ManageRecords
{
    protected static string $resource = CreditpurchaseResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
