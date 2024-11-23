<?php

namespace App\Filament\Resources\BsTwoAttendanceResource\Pages;

use App\Filament\Resources\BsTwoAttendanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBsTwoAttendance extends EditRecord
{
    protected static string $resource = BsTwoAttendanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
