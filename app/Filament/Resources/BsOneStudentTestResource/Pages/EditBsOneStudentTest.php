<?php

namespace App\Filament\Resources\BsOneStudentTestResource\Pages;

use App\Filament\Resources\BsOneStudentTestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBsOneStudentTest extends EditRecord
{
    protected static string $resource = BsOneStudentTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
