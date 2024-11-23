<?php

namespace App\Filament\Resources\FirstYearStudentTestResource\Pages;

use App\Filament\Resources\FirstYearStudentTestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFirstYearStudentTests extends ListRecords
{
    protected static string $resource = FirstYearStudentTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
