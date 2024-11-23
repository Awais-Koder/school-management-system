<?php

namespace App\Filament\Resources\BsTwoAttendanceResource\Pages;

use App\Filament\Resources\BsTwoAttendanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBsTwoAttendances extends ListRecords
{
    protected static string $resource = BsTwoAttendanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
