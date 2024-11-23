<?php

namespace App\Filament\Resources\FirstYearAttendanceResource\Pages;

use App\Filament\Resources\FirstYearAttendanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFirstYearAttendance extends EditRecord
{
    protected static string $resource = FirstYearAttendanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
