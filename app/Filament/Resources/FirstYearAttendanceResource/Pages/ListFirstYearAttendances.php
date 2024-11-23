<?php

namespace App\Filament\Resources\FirstYearAttendanceResource\Pages;

use App\Filament\Resources\FirstYearAttendanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFirstYearAttendances extends ListRecords
{
    protected static string $resource = FirstYearAttendanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
