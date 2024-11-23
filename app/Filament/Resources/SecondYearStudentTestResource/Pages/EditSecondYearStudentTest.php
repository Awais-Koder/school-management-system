<?php

namespace App\Filament\Resources\SecondYearStudentTestResource\Pages;

use App\Filament\Resources\SecondYearStudentTestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSecondYearStudentTest extends EditRecord
{
    protected static string $resource = SecondYearStudentTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
