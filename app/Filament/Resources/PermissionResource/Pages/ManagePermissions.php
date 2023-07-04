<?php

namespace App\Filament\Resources\PermissionResource\Pages;

use App\Filament\Resources\PermissionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

use Filament\Notifications\Notification;

class ManagePermissions extends ManageRecords
{
    protected static string $resource = PermissionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\CreateAction::make()
            ->successNotification(
               Notification::make()
                    ->success()
                    ->title('Permission registered')
                    ->body('The permission has been created successfully.'),
            )
        ];
    }


}
