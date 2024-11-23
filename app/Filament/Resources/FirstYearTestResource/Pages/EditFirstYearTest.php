<?php

namespace App\Filament\Resources\FirstYearTestResource\Pages;

use App\Filament\Resources\FirstYearTestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFirstYearTest extends EditRecord
{
    protected static string $resource = FirstYearTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
