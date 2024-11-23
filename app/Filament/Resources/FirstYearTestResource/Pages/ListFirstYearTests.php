<?php

namespace App\Filament\Resources\FirstYearTestResource\Pages;

use App\Filament\Resources\FirstYearTestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFirstYearTests extends ListRecords
{
    protected static string $resource = FirstYearTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
