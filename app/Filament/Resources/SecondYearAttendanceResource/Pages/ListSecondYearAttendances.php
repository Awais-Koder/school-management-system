<?php

namespace App\Filament\Resources\SecondYearAttendanceResource\Pages;

use App\Filament\Resources\SecondYearAttendanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSecondYearAttendances extends ListRecords
{
    protected static string $resource = SecondYearAttendanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
