<?php

namespace App\Filament\Resources\BsOneAttendanceResource\Pages;

use App\Filament\Resources\BsOneAttendanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBsOneAttendance extends EditRecord
{
    protected static string $resource = BsOneAttendanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
