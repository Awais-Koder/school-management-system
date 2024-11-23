<?php

namespace App\Filament\Resources\FirstYearStudentTestResource\Pages;

use App\Filament\Resources\FirstYearStudentTestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFirstYearStudentTest extends EditRecord
{
    protected static string $resource = FirstYearStudentTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
