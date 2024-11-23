<?php

namespace App\Filament\Resources\BsTwoStudentTestResource\Pages;

use App\Filament\Resources\BsTwoStudentTestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBsTwoStudentTest extends EditRecord
{
    protected static string $resource = BsTwoStudentTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
