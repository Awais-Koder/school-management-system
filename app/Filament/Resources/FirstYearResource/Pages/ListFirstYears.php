<?php

namespace App\Filament\Resources\FirstYearResource\Pages;

use App\Filament\Resources\FirstYearResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFirstYears extends ListRecords
{
    protected static string $resource = FirstYearResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
