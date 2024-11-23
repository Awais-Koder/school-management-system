<?php

namespace App\Filament\Resources\SecondYearTestResource\Pages;

use App\Filament\Resources\SecondYearTestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSecondYearTests extends ListRecords
{
    protected static string $resource = SecondYearTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
