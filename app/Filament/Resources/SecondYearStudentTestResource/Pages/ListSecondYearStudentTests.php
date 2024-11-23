<?php

namespace App\Filament\Resources\SecondYearStudentTestResource\Pages;

use App\Filament\Resources\SecondYearStudentTestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSecondYearStudentTests extends ListRecords
{
    protected static string $resource = SecondYearStudentTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
