<?php

namespace App\Filament\Resources\BsOneAttendanceResource\Pages;

use App\Filament\Resources\BsOneAttendanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBsOneAttendances extends ListRecords
{
    protected static string $resource = BsOneAttendanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
