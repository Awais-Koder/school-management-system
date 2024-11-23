<?php

namespace App\Filament\Resources\FirstYearResource\Pages;

use App\Filament\Resources\FirstYearResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFirstYear extends EditRecord
{
    protected static string $resource = FirstYearResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
