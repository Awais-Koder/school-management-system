<?php

namespace App\Filament\Resources\SecondYearTestResource\Pages;

use App\Filament\Resources\SecondYearTestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSecondYearTest extends EditRecord
{
    protected static string $resource = SecondYearTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
