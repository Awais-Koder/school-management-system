<?php

namespace App\Filament\Resources\BsEightTestResource\Pages;

use App\Filament\Resources\BsEightTestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBsEightTest extends EditRecord
{
    protected static string $resource = BsEightTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
